<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        if($request->has('category') && $request->category > 0){
            $products = Product::with('categories')->whereHas('categories', function($q) use ($request) {
                $q->where('category_id', $request->category);
            })->latest()->paginate(10);
        }
        else {
            $products = Product::latest()->paginate(10);
        }

        $categories = Category::all();

        return view('admin.product.index',['products' => $products,'categories' => $categories]);
    }
}
