<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' =>  'admin',
            'role' => 'admin',
            'no_telp' => '00000000001',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@123')
        ]);
        User::create([
            'name' =>  'customer1',
            'role' => 'customer',
            'no_telp' => '00000000001',
            'email' => 'alex@gmail.com',
            'password' => Hash::make('admin@123')
        ]);
        User::create([
            'name' =>  'customer2',
            'role' => 'customer',
            'no_telp' => '00000000001',
            'email' => 'user@gmail.com',
            'password' => Hash::make('admin@123')
        ]);
    }
}
