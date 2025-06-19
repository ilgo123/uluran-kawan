<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(5);
        return [
            // user_id dan category_id akan kita isi dari seeder
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title) . '-' . uniqid(),
            'description' => fake()->paragraphs(3, true),
            'image_path' => 'campaigns/dummy.jpg', // Siapkan satu gambar dummy di public/storage/campaigns
            'target_amount' => fake()->randomElement([500000, 1000000, 2500000, 5000000]),
            'current_amount' => function (array $attributes) {
                return fake()->numberBetween(0, $attributes['target_amount']);
            },
            'status' => fake()->randomElement(['active', 'pending', 'completed', 'rejected']),
            'type' => 'dana',
            'deadline' => fake()->dateTimeBetween('+1 week', '+3 months'),
        ];
    }
}
