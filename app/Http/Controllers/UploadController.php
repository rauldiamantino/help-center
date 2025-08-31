<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'owner_type' => 'required|string',
            'owner_id' => 'required|integer',
        ]);

        $user = Auth::user();
        $companyId = $user->company_id;
        $ownerType = $request->input('owner_type');
        $ownerId   = $request->input('owner_id');

        $file = $request->file('image');
        $folder = $companyId . '/' . $ownerId;
        $extension = $file->getClientOriginalExtension();
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = time() . '_' . Str::slug($originalName) . '.' . $extension;
        $path = $file->storeAs($folder, $fileName, 'public');

        Upload::create([
            'url' => $path,
            'company_id' => $companyId,
            'owner_type' => $ownerType,
            'owner_id' => $ownerId,
        ]);

        return response()->json([
            'success' => 1,
            'file' => [
                'url' => Storage::url($path),
            ],
        ]);
    }
}
