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

        for ($i=0; $i <2 ; $i++) {
            Story::create([
                'file' => $i,
                'description' => 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
            ]);
        }
        for ($i=0; $i <5 ; $i++) {
            Evaluation::create([
                'icon' => $i,
                'title' => "b $i",
                'description' => "a $i"
            ]);
        }
        for ($i=0; $i < 5; $i++) {
            ContactMessage::create([
                'full_name' => 'Contact',
                'email' => 'contact@',
                'message' => 'contact',
            ]);
        }
    }
}
