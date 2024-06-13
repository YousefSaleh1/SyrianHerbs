<?php

namespace App\Models;

use App\Http\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class About extends Model
{
    use HasFactory, UploadFile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'file',
    ];

    /**
     * Set the "file" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setFileAttribute($value)
    {
        $this->attributes['file'] = $this->uploadFile($value, 'About');
    }

    /**
     * Get the "file" attribute.
     *
     * @return string
     */
    public function getFileAttribute()
    {
        return asset(Storage::url($this->attributes['file']));
    }
}
