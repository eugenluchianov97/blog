<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helpers;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {

        $data = $request->validated();
        dd($data);

        $product = Product::create([
            'name' =>$data['name'],
            'name_ro' => $data['name_ro'] ?? $data['name'],
            'name_en' => $data['name_en'] ?? $data['name'],
            'description' => $data['description'],
            'description_ro' => $data['description_ro'],
            'description_en' => $data['description_en'],
            'price' => $data['price'] ?? 0.00,
            'discount_price' => $data['discount_price'],
            'recommended' => $data['recommended'] ?? false,
        ]);

        $product->categories()->attach($data['categories']);

        if (isset($data['files'])){
            foreach($request->file('files') as $key => $file) {
                ProductImage::create([
                    'image' =>  Helpers::saveImage($file,'product',370,390),
                     'product_id' =>$product->id
                ]);

            }

        }

        return redirect()->route('admin.products.index')->with('success', 'Продукт добавлен!');


    }
}
