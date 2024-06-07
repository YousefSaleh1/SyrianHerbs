<?php

namespace App\Models;

use App\Http\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    use HasFactory, UploadFile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'website_icon',
        'website_logo',
        'title',
        'description',
        'tags',
        'meta_pixel_id',
        'google_analystic_id',
    ];

    /**
     * Set the "website_icon" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setWebsiteIconAttribute($value)
    {
        $this->attributes['website_icon'] = $this->uploadFile($value, 'Setting');
    }

    /**
     * Get the "website_icon" attribute.
     *
     * @return string
     */
    public function getWebsiteIconAttribute()
    {
        return asset(Storage::url($this->website_icon));
    }

    /**
     * Set the "website_logo" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setWebsiteLogoAttribute($value)
    {
        $this->attributes['website_logo'] = $this->uploadFile($value, 'Setting');
    }

    /**
     * Get the "website_logo" attribute.
     *
     * @return string
     */
    public function getWebsiteLogoAttribute()
    {
        return asset(Storage::url($this->website_logo));
    }
}
