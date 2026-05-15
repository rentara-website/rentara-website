<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = collect(['Camera', 'Lens', 'Lighting', 'Audio', 'Accessories'])->random() . ' ' . $this->faker->numberBetween(1, 100);
        return [
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name)
        ];
    }
}
