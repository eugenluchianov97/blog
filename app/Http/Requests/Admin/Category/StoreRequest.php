<?php

namespace App\Http\Requests\Admin\Category;

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
            'slug' => 'nullable|unique:categories,slug|regex:/^[a-zA-Z0-9.]+$/u',
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'parent_id' => 'nullable'
        ];
    }
}
