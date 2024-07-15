<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Http\Traits\UploadFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Brand extends Model
{
    use HasFactory, UploadFile, Searchable;

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



    /* Search By BrandName */
    public function toSearchableArray(): array
    {
        return [
            'name'     => $this->name,
        ];
    }

    /**
     * Get the brand with categories and products
     *
     * @param int $id
     * @return Brand|null
     */
    public static function getBrandWithCategoriesAndProducts(int $id): ?Brand
    {
        return self::with([
            'categories' => function ($query) {
                $query->select('categories.id', 'categories.name')
                    ->where('published', true);
            },
            'categories.products' => function ($query) use ($id) {
                $query->select('products.id', 'products.name', 'products.additional_image', 'products.category_id', 'products.brand_id')
                    ->where('products.brand_id', $id);
            }
        ])->find($id, ['id', 'name', 'description', 'color', 'background_image', 'presentation_image', 'main_image']);
    }
    // /**
    //  * Get the brand with categories and products
    //  *
    //  * @param int $id
    //  * @return Brand|null
    //  */
    // public static function getBrandWithCategoriesAndProducts(int $id): ?Brand
    // {
    //     return self::with([
    //         'categories' => function ($query) {
    //             $query->select('categories.id', 'categories.name')
    //                 ->where('categories.published', true);
    //         },
    //         'categories.products' => function ($query) use ($id) {
    //             $query->select('products.id', 'products.name', 'products.main_image', 'products.category_id')
    //                 ->where('products.brand_id', $id);
    //         }
    //     ])->find($id, ['brands.id', 'brands.name', 'brands.description', 'brands.color', 'brands.background_image', 'brands.presentation_image', 'brands.main_image']);
    // }
}
