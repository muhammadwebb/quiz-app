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
        $categories = [
            [
                'name'=> 'Back-end',
            ],
            [
                'name'=> 'Front-end',
            ],
            [
                'name'=> 'Matematika',
            ],
            [
                'name'=> 'Fizika',
            ],
            [
                'name'=> 'Tarix',
            ],
        ];
        DB::table('categories')->insert($categories);
    }
}
