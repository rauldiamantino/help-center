<?php

namespace App\Services\Articles;

use App\Models\Upload;
use Illuminate\Support\Facades\Storage;

class CleanupOrphanUploads
{
    public static function handle(string $ownerType, int $ownerId, array $currentUrls)
    {
        $uploads = Upload::where('owner_type', $ownerType)
                         ->where('owner_id', $ownerId)
                         ->get();

        foreach ($uploads as $upload) {

            if (! in_array($upload->url, $currentUrls)) {
                Storage::disk('public')->delete($upload->url);
                $upload->delete();
            }
        }
    }
}
