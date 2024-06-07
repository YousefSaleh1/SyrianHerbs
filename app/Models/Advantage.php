<?php

namespace App\Models;

use App\Http\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Advantage extends Model
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
        'main_image',
        'image1',
        'image2',
        'image3',
        'image4',
        'image5',
    ];

    /**
     * Set the "main_image" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setMainImageAttribute($value)
    {
        $this->attributes['main_image'] = $this->uploadFile($value, 'Advantage');
    }

    /**
     * Get the "main_image" attribute.
     *
     * @return string
     */
    public function getMainImageAttribute()
    {
        return asset(Storage::url($this->main_image));
    }

    /**
     * Set the "image1" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setImage1Attribute($value)
    {
        $this->attributes['image1'] = $this->uploadFile($value, 'Advantage');
    }

    /**
     * Get the "image1" attribute.
     *
     * @return string
     */
    public function getImage1Attribute()
    {
        return asset(Storage::url($this->image1));
    }

    /**
     * Set the "image2" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setImage2Attribute($value)
    {
        $this->attributes['image2'] = $this->uploadFile($value, 'Advantage');
    }

    /**
     * Get the "image2" attribute.
     *
     * @return string
     */
    public function getImage2Attribute()
    {
        return asset(Storage::url($this->image2));
    }

    /**
     * Set the "image3" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setImage3Attribute($value)
    {
        $this->attributes['image3'] = $this->uploadFile($value, 'Advantage');
    }

    /**
     * Get the "image3" attribute.
     *
     * @return string
     */
    public function getImage3Attribute()
    {
        return asset(Storage::url($this->image3));
    }

    /**
     * Set the "image4" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setImage4Attribute($value)
    {
        $this->attributes['image4'] = $this->uploadFile($value, 'Advantage');
    }

    /**
     * Get the "image4" attribute.
     *
     * @return string
     */
    public function getImage4Attribute()
    {
        return asset(Storage::url($this->image4));
    }

    /**
     * Set the "image5" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setImage5Attribute($value)
    {
        $this->attributes['image5'] = $this->uploadFile($value, 'Advantage');
    }

    /**
     * Get the "image5" attribute.
     *
     * @return string
     */
    public function getImage5Attribute()
    {
        return asset(Storage::url($this->image5));
    }
}
