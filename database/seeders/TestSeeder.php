<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $test = \App\Models\Test::create([
            'level_id' => '1',
            'mode_id' => '1',
        ]);
        for ($i = 0; $i < 10; ++$i) {
            $question = $test->questions()->create([
                'image' => '/images/1-1.png',
                'duration' => '10',
            ]);
            $question->answers()->create([
                'image' => '/images/answer-shape-triangle.png',
                'alt_text' => '1',
                'is_correct' => true,
            ]);
            $question->answers()->create([
                'image' => '/images/answer-shape-square.png',
                'alt_text' => '2',
                'is_correct' => false,
            ]);
            $question->answers()->create([
                'image' => '/images/answer-shape-circle.png',
                'alt_text' => '3',
                'is_correct' => false,
            ]);
        }
    }
}
