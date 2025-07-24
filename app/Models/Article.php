<?php

namespace App\Models;

use App\Traits\HasSequentialNumber;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;
    use HasSequentialNumber;

    protected $fillable = [
        'article_number',
        'company_id',
        'category_id',
        'user_id',
        'title',
        'slug',
        'content',
        'status',
        'views',
    ];

    public function casts(): array
    {
        return [
            'views' => 'integer',
            'status' => 'integer',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
