<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helpers;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Category $category): \Illuminate\Http\RedirectResponse
    {
       $data = $request->validated();

        $category->name = $data['name'];
        $category->name_ro = $data['name_ro'] ?? $data['name'];
        $category->name_en = $data['name_en'] ?? $data['name'];

        $category->description = $data['description'];
        $category->description_ro = $data['description_ro'];
        $category->description_en = $data['description_en'];

        $category->parent_id = $data['parent_id'];

        $category->slug = $data['slug'] !== null ? $data['slug']  : Category::setSlug($data['name']);

        if (!isset($data['current_images'])){
            $category->image = '';
        }
        
        if(isset($data['image'])){
            $category->image =  Helpers::saveImage($data['image'],'category',790,680);
        }

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Категория ' . $data['name'] .' обновлена!');
    }
}
