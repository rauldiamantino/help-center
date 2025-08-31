<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'url',
        'owner_type',
        'owner_id',
    ];

    public function owner()
    {
        return $this->morphTo;
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
