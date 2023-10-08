<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Achievement::create([
            'id' => 1,
            'name' => 'First Login',
            'image' => '/images/achievement-login.png',
        ]);
        \App\Models\Achievement::create([
            'id' => 2,
            'name' => 'Finish Number Mode',
            'image' => '/images/achievement-mode-number.png',
        ]);
        \App\Models\Achievement::create([
            'id' => 3,
            'name' => 'Reach Score 500',
            'image' => '/images/achievement-score-500.png',
        ]);
        \App\Models\Achievement::create([
            'id' => 4,
            'name' => 'Finish Shape Mode',
            'image' => '/images/achievement-mode-shape.png',
        ]);
    }
}
