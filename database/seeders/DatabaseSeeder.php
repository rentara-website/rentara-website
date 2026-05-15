<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\ImageProduct;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Categories
        \App\Models\Category::factory(3)->create();

        // 2. Create Tags
        $this->call(TagSeeder::class);

        // 3. Create 20 Products
        $products = \App\Models\Product::factory(20)->create();

        // 4. Attach Tags ONLY to products with ID 11 to 20
        $tags = \App\Models\Tag::all();
        
        $targetProducts = $products->whereBetween('id', [11, 20]);
        
        foreach ($targetProducts as $product) {
            $randomTags = $tags->random(rand(1, 3))->pluck('id');
            $product->tags()->attach($randomTags);
        }

        // 5. Ensure Product Slugs are filled
        foreach (\App\Models\Product::all() as $product) {
            if (!$product->slug) {
                $product->slug = \Illuminate\Support\Str::slug($product->nama_produk) . '-' . $product->id;
                $product->save();
            }
        }
    }
}
