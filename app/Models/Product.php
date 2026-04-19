<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ImageProduct;
use App\Models\Category;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;


    public function image_product()
    {
        return $this->hasMany(ImageProduct::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
