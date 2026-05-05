<?php

namespace App\Models;

use App\Concerns\HasCloudinaryMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageProduct extends Model
{
    /** @use HasFactory<\Database\Factories\ImageProductFactory> */
    use HasFactory;
    use HasCloudinaryMedia;

    protected $fillable = [
        'product_id',
        'image_path'
    ];

    protected $appends = ['url'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute(): string
    {
        return $this->resolveMediaUrl($this->image_path, [
            'width' => 800,
            'quality' => 'auto',
            'fetch_format' => 'auto',
        ]);
    }
}
