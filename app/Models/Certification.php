<?php

namespace App\Models;

use App\Http\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Certification extends Model
{
    use HasFactory, UploadFile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'icon',
        'name',
        'subname',
        'photo',
        'description',
    ];

    /**
     * Set the "icon" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setIconAttribute($value)
    {
        $this->attributes['icon'] = $this->uploadFile($value, 'Certification');
    }

    /**
     * Get the "icon" attribute.
     *
     * @return string
     */
    public function getIconAttribute()
    {
        return asset(Storage::url($this->attributes['icon']));
    }

    /**
     * Set the "photo" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setPhotoAttribute($value)
    {
        $this->attributes['photo'] = $this->uploadFile($value, 'Certification');
    }

    /**
     * Get the "photo" attribute.
     *
     * @return string
     */
    public function getPhotoAttribute()
    {
        return asset(Storage::url($this->attributes['photo']));
    }
}
