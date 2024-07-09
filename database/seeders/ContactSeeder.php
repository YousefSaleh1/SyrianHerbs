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
            'email'           => 'info@siriaherbs.com',
            'phone_number'    => '+963 41 2020 ',
            'adresses'        => 'Lattakia',
            'facebook_link'   => 'https://www.facebook.com/',
            'instegram_link'  => 'https://www.instagram.com/',
            'whatsApp_number' => '+963 41 2020',
            'twitter_link'    => 'https://www.Twitter.com/',
            'linkedin_link'   => 'https://www.Linkedin.com/',
            'youtube_link'    => 'https://www.youtube.com/',
        ]);
    }
}
