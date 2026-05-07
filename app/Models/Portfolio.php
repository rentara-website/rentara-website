<?php

namespace App\Models;

use App\Concerns\HasCloudinaryMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    /** @use HasFactory<\Database\Factories\PortfolioFactory> */
    use HasFactory;
    use HasCloudinaryMedia;

    protected $fillable = [
        'category_id',
        'product_id',
        'type',
        'file_path',
        'title'
    ];

    protected $appends = ['url'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getUrlAttribute(): string
    {
        if ($this->type === 'video') {
            return $this->resolveMediaUrl($this->file_path, [
                'width' => 1280,
                'quality' => 'auto',
            ], 'video');
        }

        return $this->resolveMediaUrl($this->file_path, [
            'width' => 1200,
            'quality' => 'auto',
            'fetch_format' => 'auto',
        ]);
    }
}
