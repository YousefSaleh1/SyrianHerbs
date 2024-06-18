<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use App\Http\Traits\UploadFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, UploadFile ,  Searchable;

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


    /* Search By Name Product */
   /*  public function toSearchableArray(): array
    {
        return [
            'name'     => $this->name,
            'subname1' => $this->subname1,
            'subname2' => $this->subname2,
        ];
    }
 */

  /*   public function toSearchableArray(): array
    {
        $searchable = [];

        if (!empty($this->name)&& !empty($this->subname1)&& !empty($this->subname2)) {
            $searchable = [
                'name'     => $this->name,
                'subname1' => $this->subname1,
                'subname2' => $this->subname2,
            ];
        } elseif (!empty($this->brand->name)) {
            $searchable = [
                'brand'  => $this->brand->name,
            ];
        }
    
        return $searchable;
    } */

}
