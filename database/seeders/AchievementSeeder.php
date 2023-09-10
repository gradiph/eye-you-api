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
            'image' => '/first-login.jpg',
        ]);
        \App\Models\Achievement::create([
            'id' => 2,
            'name' => 'Finish Number Mode',
            'image' => '/finish-number-mode.jpg',
        ]);
        \App\Models\Achievement::create([
            'id' => 3,
            'name' => 'Reach Score 500',
            'image' => '/reach-score-500.jpg',
        ]);
        \App\Models\Achievement::create([
            'id' => 4,
            'name' => 'Finish Shape Mode',
            'image' => '/finish-shape-mode.jpg',
        ]);
    }
}
