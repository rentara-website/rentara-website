<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /** @use HasFactory<\Database\Factories\RatingFactory> */
    use HasFactory;

    protected $fillable = [
        "product_id",
        "email",
        "rating",
        "nama",
        "komentar"
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
