<?php

namespace App\Models;

use App\Http\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Hero extends Model
{
    use HasFactory, UploadFile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'image',
        'title',
        'page',
    ];

    /**
     * Set the "image" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setImageAttribute($value)
    {
        $this->attributes['image'] = $this->uploadFile($value, 'Hero');
    }

    /**
     * Get the "image" attribute.
     *
     * @return string
     */
    public function getImageAttribute()
    {
        return asset(Storage::url($this->image));
    }
}
