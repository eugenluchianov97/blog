<?php

namespace App\Http\Requests\Admin\Post;

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
            'name_ru' => 'required',
            'name_ro' => 'nullable',
            'name_en' => 'nullable',
            'content_ru' => 'nullable',
            'content_ro' => 'nullable',
            'content_en' => 'nullable',
            'preview_picture' => 'nullable|image|mimes:jpeg,png,jpg',
            'categories_id' => 'required',
            'current_image' => 'nullable'
        ];
    }
}
