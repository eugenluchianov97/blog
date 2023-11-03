<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helpers;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class UpdateController extends Controller
{

    public function __invoke(UpdateRequest $request, Post $post): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
//        dump(isset($data['current_image']) === false && isset($data['preview_picture']) === false);
//        dd($data);

        $post->name_ru =  $data['name_ru'];
        $post->name_ro =  $data['name_ro'] ?? $data['name_ru'] ;
        $post->name_en =  $data['name_en'] ?? $data['name_ru'];
        $post->content_ru = $data['content_ru'];
        $post->content_ro = $data['content_ro'];
        $post->content_en = $data['content_en'];

        if(isset($data['preview_picture'])){
            $post->preview_picture = Helpers::saveImage($data['preview_picture'],'product',500,500);
        }

        if(!isset($data['current_image']) && !isset($data['preview_picture'])){
            $post->preview_picture = null;
        }

        $post->categories()->sync($data['categories_id']);

        $post->save();

        return redirect()->route('admin.posts.index')->with('success', 'Пост обновлен!');
    }
}
