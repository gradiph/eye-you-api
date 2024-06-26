<?php

namespace Database\Seeders;

use App\Models\Mode;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Mode::create([
            'id' => Mode::NUMBER,
            'name' => 'Number',
            'image' => '/images/1-1.png',
            'deleted_at' => now()
        ]);
        Mode::create([
            'id' => Mode::SHAPE,
            'name' => 'Shape',
            'image' => '/images/TRIANGLE-3.png',
            'deleted_at' => now()
        ]);
        Mode::create([
            'id' => Mode::ISHIHARA,
            'name' => 'Mode Ishihara',
            'image' => '/images/1-1.png',
        ]);
    }
}
