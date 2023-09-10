<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Level::create([
            'id' => 1,
            'difficulty' => 1,
            'name' => 'Easy',
        ]);
        \App\Models\Level::create([
            'id' => 2,
            'difficulty' => 9,
            'name' => 'Hard',
        ]);
    }
}
