<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\About;
use App\Models\ContactMessage;
use App\Models\Evaluation;
use App\Models\Story;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(AboutSeeder::class);
        $this->call(AdvantageSeeder::class);
        $this->call(ContactSeeder::class);
        $this->call(HeroSeeder::class);
        $this->call(SettingSeeder::class);
    }
}
