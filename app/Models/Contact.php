<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'phone_number',
        'adresses',
        'facebook_link',
        'instegram_link',
        'whatsApp_number',
        'twitter_link',
        'linkedin_link',
        'youtube_link',
    ];
}
