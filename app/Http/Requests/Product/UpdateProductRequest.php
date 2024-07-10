<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name'                  => 'nullable|string|max:255',
            'subname1'              => 'nullable|string|max:255',
            'subname2'              => 'nullable|string|max:255',
            'product_description'   => 'nullable|string|max:10000',
            'code_number'           => 'nullable|numeric|between 1,100000',
            'weight'                => 'nullable|numeric|between:0.01,100000.00',
            'packaging_description' => 'nullable|string|max:10000',
            'description_component' => 'nullable|string|max:10000',
            'count_each_package'    => 'nullable|integer|between:1,1000000',
            'main_image'            => 'nullable|file|mimes:png,jpg,jpeg|mimetypes:image/jpeg,image/png,image/jpg,image',
            'additional_image'      => 'nullable|file|mimes:png,jpg,jpeg|mimetypes:image/jpeg,image/png,image/jpg,image',
        ];
    }
}
