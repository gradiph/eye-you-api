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
                'image' => '/images/1-'.fake()->numberBetween(1, 5).'.png',
                'duration' => '10',
            ]);
            $question->answers()->create([
                'image' => '/images/answer-1.png',
                'alt_text' => '1',
                'is_correct' => true,
            ]);
            $question->answers()->create([
                'image' => '/images/answer-2.png',
                'alt_text' => '2',
                'is_correct' => false,
            ]);
            $question->answers()->create([
                'image' => '/images/answer-3.png',
                'alt_text' => '3',
                'is_correct' => false,
            ]);
            $question->answers()->create([
                'image' => '/images/answer-4.png',
                'alt_text' => '4',
                'is_correct' => false,
            ]);
            $question->answers()->create([
                'image' => '/images/answer-5.png',
                'alt_text' => '5',
                'is_correct' => false,
            ]);
            $question->answers()->create([
                'image' => '/images/answer-6.png',
                'alt_text' => '6',
                'is_correct' => false,
            ]);
            $question->answers()->create([
                'image' => '/images/answer-7.png',
                'alt_text' => '7',
                'is_correct' => false,
            ]);
            $question->answers()->create([
                'image' => '/images/answer-8.png',
                'alt_text' => '8',
                'is_correct' => false,
            ]);
            $question->answers()->create([
                'image' => '/images/answer-9.png',
                'alt_text' => '9',
                'is_correct' => false,
            ]);
        }
        // $test = \App\Models\Test::create([
        //     'level_id' => '1',
        //     'mode_id' => '2',
        // ]);
        // for ($i = 0; $i < 10; ++$i) {
        //     $question = $test->questions()->create([
        //         'image' => '/images/SQUARE-1.png',
        //         'duration' => '10',
        //     ]);
        //     $question->answers()->create([
        //         'image' => '/images/answer-shape-triangle.png',
        //         'alt_text' => 'triangle',
        //         'is_correct' => true,
        //     ]);
        //     $question->answers()->create([
        //         'image' => '/images/answer-shape-square.png',
        //         'alt_text' => 'square',
        //         'is_correct' => false,
        //     ]);
        //     $question->answers()->create([
        //         'image' => '/images/answer-shape-circle.png',
        //         'alt_text' => 'circle',
        //         'is_correct' => false,
        //     ]);
        // }
    }
}
