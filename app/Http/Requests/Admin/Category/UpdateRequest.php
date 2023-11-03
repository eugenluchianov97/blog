<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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

            'slug' => 'nullable|regex:/^[a-zA-Z0-9.]+$/u|unique:categories,slug,'. $this->category->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg',
            'parent_id' => 'nullable'
        ];
    }
}
