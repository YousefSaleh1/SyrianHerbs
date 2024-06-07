<?php

namespace App\Models;

use App\Http\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Policy extends Model
{
    use HasFactory, UploadFile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'policy_number',
        'icon',
        'title',
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
        $this->attributes['icon'] = $this->uploadFile($value, 'Policy');
    }

    /**
     * Get the "icon" attribute.
     *
     * @return string
     */
    public function getIconAttribute()
    {
        return asset(Storage::url($this->icon));
    }
}
