<?php

namespace App\Models;

use App\Traits\Responses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'price',
        'image',
        'description',
        'category_id'
    ];

    protected $with = ['category:name'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
