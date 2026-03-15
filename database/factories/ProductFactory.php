<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nama_produk" => $this->faker->word(),
            "harga" => $this->faker->numberBetween(10000, 100000),
            "deskripsi" => $this->faker->paragraph(),
            "category_id" => \App\Models\Category::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}
