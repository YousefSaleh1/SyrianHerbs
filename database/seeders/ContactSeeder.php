<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'email'           => '',
            'phone_number'    => '',
            'adresses'        => '',
            'facebook_link'   => '',
            'instegram_link'  => '',
            'whatsApp_number' => '',
            'twitter_link'    => '',
            'linkedin_link'   => '',
            'youtube_link'    => '',
        ]);
    }
}
