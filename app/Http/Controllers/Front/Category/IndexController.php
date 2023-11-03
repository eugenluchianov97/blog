<?php

namespace App\Http\Controllers\Front\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $slug = $request->slug;
        $subcategories = Category::whereHas('parent', function($q) use($slug) {
            $q->where('slug', $slug);
        })->get();

        return view('front.category.index',['subcategories' => $subcategories]);
    }
}
