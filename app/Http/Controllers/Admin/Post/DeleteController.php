<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    public function __invoke(Post $post): \Illuminate\Http\RedirectResponse
    {
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Пост успешно удалена!');
    }
}
