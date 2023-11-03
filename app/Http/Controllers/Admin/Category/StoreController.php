<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helpers;
use App\Http\Requests\Admin\Category\StoreRequest;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();

        Category::create([
            'name' =>$data['name'],
            'name_ro' => $data['name_ro'] ?? $data['name'],
            'name_en' => $data['name_en'] ?? $data['name'],
            'description' => $data['description'],
            'description_ro' => $data['description_ro'],
            'description_en' => $data['description_en'],
            'parent_id' => $data['parent_id'] ?? null,
            'slug' => $data['slug'] !== null ? $data['slug']  : Category::setSlug($data['name']),
            'image' => isset($data['image']) ? Helpers::saveImage($data['image'],'category',790,680) : null
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Категория ' . $data['name'] .' создана!');
    }
}
