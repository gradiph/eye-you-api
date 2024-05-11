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
            'name' => 'Berhasil masuk!',
            'image' => '/images/achievement-login.png',
            'order' => 1,
        ]);
        Achievement::create([
            'id' => Achievement::FINISH_NUMBER_MODE,
            'name' => 'Selesaikan mode angka!',
            'image' => '/images/achievement-mode-number.png',
            'order' => 2,
            'deleted_at' => now(),
        ]);
        Achievement::create([
            'id' => Achievement::REACH_SCORE_500,
            'name' => 'Capai skor 500!',
            'image' => '/images/achievement-score-500.png',
            'order' => 3,
            'deleted_at' => now(),
        ]);
        Achievement::create([
            'id' => Achievement::FINISH_SHAPE_MODE,
            'name' => 'Finish Shape Mode',
            'image' => '/images/achievement-mode-shape.png',
            'order' => 4,
            'deleted_at' => now(),
        ]);
        Achievement::create([
            'id' => Achievement::REACH_SCORE_1500,
            'name' => 'Capai skor 1500!',
            'image' => '/images/achievement-score-500.png',
            'order' => 5,
            'deleted_at' => now(),
        ]);
        Achievement::create([
            'id' => Achievement::FINISH_ISHIHARA_MODE,
            'name' => 'Selesaikan mode Ishihara!',
            'image' => '/images/achievement-mode-ishihara.png',
            'order' => 2,
        ]);
        Achievement::create([
            'id' => Achievement::REACH_SCORE_5000,
            'name' => 'Capai skor 5000!',
            'image' => '/images/achievement-score-5000.png',
            'order' => 3,
        ]);
        Achievement::create([
            'id' => Achievement::REACH_SCORE_7500,
            'name' => 'Capai skor 7500!',
            'image' => '/images/achievement-score-7500.png',
            'order' => 4,
        ]);
        Achievement::create([
            'id' => Achievement::REACH_SCORE_10000,
            'name' => 'Capai skor 10000!',
            'image' => '/images/achievement-score-10000.png',
            'order' => 5,
        ]);
        Achievement::create([
            'id' => Achievement::ALL_ANSWER_CORRECT,
            'name' => 'Jawaban semua benar!',
            'image' => '/images/achievement-all-correct.png',
            'order' => 6,
        ]);
    }
}
