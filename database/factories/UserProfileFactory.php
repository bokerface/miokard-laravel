<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProfile>
 */
class UserProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'gender' => fake()->randomElement(['laki-laki', 'perempuan']),
            'origin_address' => fake()->address(),
            'phone' => fake()->phoneNumber(),
            'emergency_phone' => fake()->phoneNumber(),
            'date_of_birth' => fake()->date(),
        ];
    }
}
