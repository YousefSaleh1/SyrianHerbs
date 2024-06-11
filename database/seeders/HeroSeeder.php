<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Hero::create([
            // 'image' => '',
            'title' => '',
            'page'  => 'main',
        ]);

        Hero::create([
            // 'image' => '',
            'title' => '',
            'page'  => 'about',
        ]);
    }
}
