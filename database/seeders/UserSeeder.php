<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'User1',
            'email' => 'user1@email.com',
            'username' => 'user1',
            'password' => 'rahasia',
            'avatar' => 'storage/images/user-default.png',
        ]);
    }
}
