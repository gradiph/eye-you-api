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
            'name' => 'Number',
            'image' => '/images/1-1.png',
        ]);
        \App\Models\Mode::create([
            'name' => 'Shape',
            'image' => '/images/TRIANGLE-3.png',
        ]);
    }
}
