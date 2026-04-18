<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySlugSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Category::all()->each(function($category) {
            $category->update([
                'slug' => \Illuminate\Support\Str::slug($category->name)
            ]);
        });
    }
}
