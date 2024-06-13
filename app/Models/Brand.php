<?php

namespace App\Models;

use App\Http\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Brand extends Model
{
    use HasFactory, UploadFile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'background_image',
        'description',
        'main_image',
        'presentation_image',
        'published',
        'color',
    ];

    /**
     * The categories that belong to the Brand
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'brand_category');
    }

    /**
     * Get all of the products for the Brand
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    /**
     * Set the "background_image" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setBackgroundImageAttribute($value)
    {
        $this->attributes['background_image'] = $this->uploadFile($value, 'Brand');
    }

    /**
     * Get the "background_image" attribute.
     *
     * @return string
     */
    public function getBackgroundImageAttribute()
    {
        return asset(Storage::url($this->attributes['background_image']));
    }

    /**
     * Set the "main_image" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setMainImageAttribute($value)
    {
        $this->attributes['main_image'] = $this->uploadFile($value, 'Brand');
    }

    /**
     * Get the "main_image" attribute.
     *
     * @return string
     */
    public function getMainImageAttribute()
    {
        return asset(Storage::url($this->attributes['main_image']));
    }

    /**
     * Set the "presentation_image" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setPresentationImageAttribute($value)
    {
        $this->attributes['presentation_image'] = $this->uploadFile($value, 'Brand');
    }

    /**
     * Get the "presentation_image" attribute.
     *
     * @return string
     */
    public function getPresentationImageAttribute()
    {
        return asset(Storage::url($this->attributes['presentation_image']));
    }
}
