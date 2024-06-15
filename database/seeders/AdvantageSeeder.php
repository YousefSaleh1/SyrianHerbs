<?php

namespace Database\Seeders;

use App\Models\Advantage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdvantageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Advantage::create([
            'title'       => 'test',
            'description' => 'test',
            // 'main_image'  => '',
            // 'image1'      => '',
            // 'image2'      => '',
            // 'image3'      => '',
            // 'image4'      => '',
            // 'image5'      => '',
        ]);
    }
}
