<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function __invoke(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {

        if($request->has('category') && $request->category > 0){
            $posts = Post::with('categories')->whereHas('categories', function($q) use ($request) {
                $q->where('category_id', $request->category);
            })->latest()->paginate(10);
        }
        else {
            $posts = Post::latest()->paginate(10);
        }

        $categories = Category::all();

        return view('admin.post.index',['posts' => $posts, 'categories' => $categories]);
    }
}
