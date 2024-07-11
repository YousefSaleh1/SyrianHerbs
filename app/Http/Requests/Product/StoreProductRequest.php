<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'brand_id'              => 'required|integer|exists:brands,id',
        'category_id'           => 'required|integer|exists:categories,id',
        'name'                  => 'required|string|max:255',
        'subname1'              => 'required|string|max:255',
        'subname2'              => 'required|string|max:255',
        'product_description'   => 'required|string|max:10000',
        'code_number'           => 'required|numeric',
        'weight'                => 'required|numeric|between:0.01,100000.00',
        'packaging_description' => 'required|string|max:10000',
        'description_component' => 'required|string|max:10000',
        'count_each_package'    => 'required|integer|between:1,1000000',
        'main_image'            => 'required|file|mimes:png,jpg,jpeg|mimetypes:image/jpeg,image/png,image/jpg,image',
        'additional_image'      => 'required|file|mimes:png,jpg,jpeg|mimetypes:image/jpeg,image/png,image/jpg,image',
        ];
    }
}
