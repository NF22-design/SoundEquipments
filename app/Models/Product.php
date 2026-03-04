<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'price', 'stock', 'image', 'category_id', 'brand'
    ];
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
