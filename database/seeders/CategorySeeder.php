<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'name' => 'Jurnal Reading'
        ]);

        DB::table('categories')->insert([
            'name' => 'Textbook Reading'
        ]);

        DB::table('categories')->insert([
            'name' => 'Case Report'
        ]);

        DB::table('categories')->insert([
            'name' => 'Literature Review'
        ]);

        DB::table('categories')->insert([
            'name' => 'lain-lain'
        ]);


        DB::table('categories')->insert([
            'name' => 'Proposal Thesis'
        ]);

        DB::table('categories')->insert([
            'name' => 'Hasil Thesis'
        ]);

        DB::table('categories')->insert([
            'name' => 'Case Report 1'
        ]);

        DB::table('categories')->insert([
            'name' => 'Case Report 2'
        ]);

        DB::table('categories')->insert([
            'name' => 'Literature Review Related Thesis'
        ]);

        DB::table('categories')->insert([
            'name' => 'Clinical Literature Review'
        ]);
    }
}
