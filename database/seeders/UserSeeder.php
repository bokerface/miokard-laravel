<?php

namespace Database\Seeders;

use App\Models\StudentClinicalRotation;
use App\Models\User;
use App\Models\UserProfile;
use Carbon\Carbon;
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
                            'name' => 'asdas'
                        ];
                    })
            )
            ->has(
                StudentClinicalRotation::factory()
                    ->state(function (array $attributes, User $user) {
                        return [
                            'clinical_rotation_id' => 1,
                            'start_date' => Carbon::now()
                        ];
                    })
            )
            ->create([
                'role_id' => 2,
                'email' => 'user@test.mail'
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
