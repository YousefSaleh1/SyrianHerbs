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
        About::create([
            'title'       => '',
            'description' => '',
            // 'file'        => storage_path('storage/app/public/Test/photo_٢٠٢٣-٠٥-٢٢_٠١-٠٢-١٨.jpg'),
        ]);
    }
}
