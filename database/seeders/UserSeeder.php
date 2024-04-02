<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(
                UserProfile::factory()
                    ->state(function (array $attributes, User $user) {
                        return [
                            'student_id' => '123123',
                        ];
                    })
            )
            ->create([
                'role_id' => 2
            ]);

        User::factory()
            ->has(
                UserProfile::factory()
                    ->state(function (array $attributes, User $user) {
                        return [
                            'sip_id' => '123123',
                        ];
                    })
            )
            ->create([
                'role_id' => 3
            ]);
    }
}
