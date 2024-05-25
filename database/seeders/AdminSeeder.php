<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(UserProfile::factory()
                ->state(function (array $attributes, User $user) {
                    return [
                        'name' => 'Admin',
                    ];
                }))
            ->create([
                'email' => 'badkorayonkasihan@gmail.com',
                'password' => bcrypt('pass'),
                'role_id' => 1
            ]);
    }
}
