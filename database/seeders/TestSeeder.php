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
        $modes = \App\Models\Mode::all();
        foreach ($modes as $mode) {
            $test = $mode->tests()->create();

            $i = 0;
            foreach ($mode->levels()->oldest('difficulty')->get() as $level) {
                $test->levels()->create([
                    'level_id' => $level->id,
                    'order' => $i++,
                    'count' => 5,
                ]);
            }
        }
    }
}
