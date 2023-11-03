<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'name_ro' => 'nullable',
            'name_en' => 'nullable',
            'description' => 'nullable',
            'description_ro' => 'nullable',
            'description_en' => 'nullable',
            'price' => 'nullable',
            'discount_price' => 'nullable',
            'files' => 'nullable',
            'files.*' => 'nullable|image|mimes:jpeg,png,jpg',
            'recommended' => 'nullable',
            'categories' => 'required',
        ];
    }
}
