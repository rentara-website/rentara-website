<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    private static $counter = 0;
    private static $categories = ["Content Equipment", "Photographer", "Videographer"];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = self::$categories[self::$counter % count(self::$categories)];
        self::$counter++;
        
        return [
            "name" => $name,
        ];
    }
}
