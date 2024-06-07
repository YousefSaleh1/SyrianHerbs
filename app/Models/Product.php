<?php

namespace App\Models;

use App\Http\Traits\UploadFile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory, UploadFile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'subname1',
        'subname2',
        'product_description',
        'code_number',
        'weight',
        'packaging_description',
        'description_component',
        'count_each_package',
        'main_image',
        'additional_image',
    ];

    /**
     * Get the brand that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'other_key');
    }

    /**
     * Set the "main_image" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setMainImageAttribute($value)
    {
        $this->attributes['main_image'] = $this->uploadFile($value, 'Product');
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
     * Set the "additional_image" attribute.
     *
     * @param  mixed  $value
     * @return void
     */
    public function setAdditionalImageAttribute($value)
    {
        $this->attributes['additional_image'] = $this->uploadFile($value, 'Product');
    }

    /**
     * Get the "additional_image" attribute.
     *
     * @return string
     */
    public function getAdditionalImageAttribute()
    {
        return asset(Storage::url($this->additional_image));
    }
}
