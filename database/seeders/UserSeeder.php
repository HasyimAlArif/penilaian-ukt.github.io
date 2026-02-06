<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@pagarnusa.or.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
        
        // Petugas Default
        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@pagarnusa.or.id',
            'password' => Hash::make('petugas123'),
            'role' => 'petugas',
        ]);
    }
}
