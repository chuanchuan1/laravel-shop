<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'title', 'description', 'image', 'on_sale',
        'rating', 'sold_count', 'review_count', 'price'
    ];

    protected $casts = [
        'on_sale' => 'boolean'
    ];

    public function getImageUrlAttribute()
    {
        if ($this->hasCompleteUrl($this->attributes['image'])) {
            return $this->attributes['image'];
        }

        return \Storage::disk('admin')->url($this->attributes['image']);
    }

    public function hasCompleteUrl($url)
    {
        return Str::startsWith($url, ['http://', 'https://']);
    }

    // 与商品 SKU 关联
    public function skus()
    {
        return $this->hasMany(ProductSku::class);
    }
}
