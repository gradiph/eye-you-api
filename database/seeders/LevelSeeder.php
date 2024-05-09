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
        $modes = \App\Models\Mode::all();
        foreach ($modes as $mode) {
            $mode->levels()->create([
                'difficulty' => 1,
                'name' => 'Easy',
                'score' => 100,
            ]);
            $mode->levels()->create([
                'difficulty' => 5,
                'name' => 'Normal',
                'score' => 200,
            ]);
            $mode->levels()->create([
                'difficulty' => 9,
                'name' => 'Hard',
                'score' => 300,
            ]);
        }
    }
}
