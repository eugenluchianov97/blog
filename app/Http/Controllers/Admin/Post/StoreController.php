<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helpers;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{

    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();


        $post = Post::create([
            'name_ru' => $data['name_ru'],
            'name_ro' => $data['name_ro'] ?? $data['name_ru'],
            'name_en' => $data['name_en'] ?? $data['name_ru'],
            'content_ru' => $data['content_ru'],
            'content_ro' => $data['content_ro'] ?? $data['content_ru'],
            'content_en' => $data['content_en'] ?? $data['content_ru'],
            'preview_picture' => $data['preview_picture'] ? Helpers::saveImage($data['preview_picture'],'product',500,500) : '' ,

        ]);

        $post->categories()->attach($data['categories_id']);

        return redirect()->route('admin.posts.index')->with('success', 'Пост добавлен!');
    }
}
