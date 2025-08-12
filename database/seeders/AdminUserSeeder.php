<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    DB::table('users')->insert([
        'name' => 'admin',
        'phone' => '081234567890',
        'gender' => 'Laki-laki',
        'birth_date' => '1990-01-01',
        'email' => 'admin@kliktumbas.com',
        'email_verified_at' => now(),
        'password' => Hash::make('admin123'),
        'role' => 'admin',
        'remember_token' => null,
        'created_at' => now(),
        'updated_at' => now()
    ]);
}

}
