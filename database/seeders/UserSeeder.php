<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Muhammad',
                'phone' => '+998991234567',
                'password' => Hash::make('123'),
                'is_premium' => true,
                'is_admin' => true,
                'verified'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Max',
                'phone' => '+998991234568',
                'password' => Hash::make('123'),
                'is_premium' => true,
                'is_admin' => true,
                'verified'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'john',
                'phone' => '+998991234569',
                'password' => Hash::make('123'),
                'is_premium' => true,
                'is_admin' => true,
                'verified'=> true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        DB::table('users')->insert($users);
    }
}
