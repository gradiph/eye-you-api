<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Mode::create([
            'id' => 1,
            'name' => 'Number',
            'image' => '/images/1-1.png',
        ]);
        \App\Models\Mode::create([
            'id' => 2,
            'name' => 'Shape',
            'image' => '/images/TRIANGLE-3.png',
        ]);
    }
}
