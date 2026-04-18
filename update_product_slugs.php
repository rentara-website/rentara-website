<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\Product;
use Illuminate\Support\Str;

foreach (Product::all() as $product) {
    if (!$product->slug) {
        $product->slug = Str::slug($product->nama_produk) . '-' . $product->id;
        $product->save();
        echo "Updated: {$product->nama_produk} -> {$product->slug}\n";
    }
}

echo "All slugs updated.\n";
