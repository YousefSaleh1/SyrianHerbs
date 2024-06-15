<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filePath = storage_path('storage/app/app/aboutus.jfif');

        About::create([
            'title'       => 'About Us Title',
            'description' => 'This is the about us description.',
            // 'file' => $filePath,
        ]);
    }
}
