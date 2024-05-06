<?php

namespace Database\Seeders;

use App\Models\Achievement;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Achievement::create([
            'id' => Achievement::FIRST_LOGIN,
            'name' => 'First Login',
            'image' => '/images/achievement-login.png',
        ]);
        Achievement::create([
            'id' => Achievement::FINISH_NUMBER_MODE,
            'name' => 'Finish Number Mode',
            'image' => '/images/achievement-mode-number.png',
        ]);
        Achievement::create([
            'id' => Achievement::REACH_SCORE_500,
            'name' => 'Reach Score 500',
            'image' => '/images/achievement-score-500.png',
        ]);
        Achievement::create([
            'id' => Achievement::FINISH_SHAPE_MODE,
            'name' => 'Finish Shape Mode',
            'image' => '/images/achievement-mode-shape.png',
        ]);
    }
}
