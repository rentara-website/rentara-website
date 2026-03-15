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
        // User::factory(10)->create();

        Category::factory(3)->create();

        Product::factory(10)->create();

        ImageProduct::factory(10)->create();
    }
}
