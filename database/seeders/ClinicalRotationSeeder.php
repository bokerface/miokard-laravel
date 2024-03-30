<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClinicalRotationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clinical_rotations')->insert([
            'name' => 'Pembekalan',
            'stage' => 1
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'IPD',
            'stage' => 1
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'IKA-1',
            'stage' => 1
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'PARU',
            'stage' => 1
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Kardiologi Klinik',
            'stage' => 2
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Diagnostik Non Invasif',
            'stage' => 2
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Vaskular',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Electrophysiology',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Preventif dan Rehabilitasi Jantung',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Imaging',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Post-Op Bedah Jantung',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'IKA-2',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Kongenital',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Penelitian',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'CVCU',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'IGD',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'RSUB',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Diagnostik Invasif',
            'stage' => 3
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Integrasi Invasif',
            'stage' => 4
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Intgerasi Cardiac Intensive Care dan Ward',
            'stage' => 4
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Integrasi',
            'stage' => 4
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'DNI',
            'stage' => 4
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'RSUD dr Iskak',
            'stage' => 4
        ]);

        DB::table('clinical_rotations')->insert([
            'name' => 'Interasi Poli dan Konsulan ',
            'stage' => 4
        ]);
    }
}
