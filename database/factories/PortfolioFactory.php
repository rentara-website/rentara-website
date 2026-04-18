<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['image', 'image', 'image', 'video']); // mostly images
        
        $images = [
            'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?w=800&auto=format', // Event
            'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=800&auto=format', // Wedding
            'https://images.unsplash.com/photo-1511895426328-dc8714191300?w=800&auto=format', // Photographer
            'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=800&auto=format', // Camera
            'https://images.unsplash.com/photo-1604908176997-125f25cc6f3d?w=800&auto=format', // Podcast/Content
            'https://images.unsplash.com/photo-1532712938310-34cb3982ef74?w=800&auto=format', // Video edit
        ];

        $videos = [
            'https://www.w3schools.com/html/mov_bbb.mp4', 
            'http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4',
        ];

        return [
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id ?? 1,
            'product_id' => \App\Models\Product::inRandomOrder()->first()?->id,
            'type' => $type,
            'file_path' => $type === 'image' ? $this->faker->randomElement($images) : $this->faker->randomElement($videos),
            'title' => $this->faker->sentence(4),
        ];
    }
}
