<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Achievement;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(LevelSeeder::class);
        $this->call(ModeSeeder::class);
        $this->call(AchievementSeeder::class);
        $this->call(TestSeeder::class);
        $this->call(UserSeeder::class);
    }
}
