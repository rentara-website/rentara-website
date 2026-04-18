<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            ['name' => 'Wedding', 'slug' => 'wedding'],
            ['name' => 'Wisuda', 'slug' => 'wisuda'],
            ['name' => 'Content Creator', 'slug' => 'content-creator'],
            ['name' => 'Fotografi', 'slug' => 'fotografi'],
            ['name' => 'Videografi', 'slug' => 'videografi'],
        ];

        foreach ($tags as $tag) {
            \App\Models\Tag::updateOrCreate(['slug' => $tag['slug']], $tag);
        }
    }
}
