<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // user_id dan campaign_id akan diisi dari seeder
            'amount' => fake()->randomElement([25000, 50000, 100000, 200000]),
            'status' => 'success',
            'is_anonymous' => fake()->boolean(20), // 20% kemungkinan anonim
        ];
    }
}
