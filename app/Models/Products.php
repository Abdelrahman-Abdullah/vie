<?php

namespace App\Models;

use App\Traits\Responses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory, Responses;
    protected $fillable = [
        'name',
        'slug',
        'price',
        'image',
        'description',
        'category_id'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
