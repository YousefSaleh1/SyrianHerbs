<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'website_icon'        => '',
            'website_logo'        => '',
            'title'               => '',
            'description'         => '',
            'tags'                => '',
            'meta_pixel_id'       => '',
            'google_analystic_id' => '',
        ]);
    }
}
