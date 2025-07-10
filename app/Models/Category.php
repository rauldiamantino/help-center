<?php

namespace App\Models;

use App\Models\Company;
use App\Traits\HasSequentialNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use HasSequentialNumber;

    protected $fillable = [
        'category_number',
        'company_id',
        'name',
        'slug',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
