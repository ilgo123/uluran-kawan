<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Semua ID relasi akan diisi dari seeder
            'rating' => fake()->numberBetween(4, 5),
            'comment' => fake()->sentence(),
            'status' => 'visible',
        ];
    }
}
