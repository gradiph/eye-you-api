<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class QuestionSeeder extends Seeder
{
    const QUESTIONS = [
        \App\Models\Level::EASY => [
            '1' => 4,
            '2' => 3,
            '3' => 4,
            '4' => 2,
            '5' => 3,
            '6' => 1,
            '7' => 2,
            '8' => 1,
            '9' => 2,
        ],
        \App\Models\Level::NORMAL => [
            '12' => 1,
            '16' => 1,
            '29' => 1,
            '35' => 1,
            '45' => 1,
            '74' => 1,
            '96' => 1,
        ],
        \App\Models\Level::HARD => [
            '1' => 1,
            '3' => 1,
            '4' => 2,
            '5' => 1,
            '6' => 3,
            '7' => 2,
            '8' => 1,
            '9' => 1,
            '16' => 1,
            '23' => 1,
            '29' => 1,
            '45' => 1,
            '97' => 1,
        ],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $testLevels = \App\Models\TestLevel::all();
        Log::debug('QuestionSeeder', ['testLevels' => $testLevels]);
        foreach ($testLevels as $testLevel) {
            Log::debug('QuestionSeeder', ['testLevel' => $testLevel]);
            foreach (QuestionSeeder::QUESTIONS[$testLevel->level->difficulty] as $answer => $n) {
                Log::debug('QuestionSeeder', ['answer' => $answer, 'n' => $n]);
                for ($i = 1; $i <= $n; $i++) {
                    $testLevel->questions()->create([
                        'image' => "/images/questions/{$testLevel->level->difficulty}-$answer-$i.png",
                        'duration' => 10,
                        'answer' => $answer,
                    ]);
                }
            }
        }
    }
}
