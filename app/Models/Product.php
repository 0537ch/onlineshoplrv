<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'images',
        'description',
        'price',
        'is_active',
        'is_featured',
        'in_stock',
        'on_sale',
    ];
    protected $casts = [
        'images' => 'array',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class); // Produk ini milik satu kategori
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class); // Produk ini milik satu brand
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class); // Satu produk memiliki banyak order item
    }
}