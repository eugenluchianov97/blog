<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helpers;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class UpdateController extends Controller
{

    public function __invoke(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        $product->name = $data['name'];
        $product->name_ro = $data['name_ro'] ?? $data['name'];
        $product->name_en = $data['name_en'] ?? $data['name'];

        $product->description = $data['description'] ;
        $product->description_ro = $data['description_ro'];
        $product->description_en = $data['description_en'];

        $product->price = $data['price'] ?? 0.00;
        $product->discount_price = $data['discount_price'];
        $product->recommended = $data['recommended'] ?? false;

        $product->categories()->sync($data['categories']);

        if (isset($data['current_images'])){
            ProductImage::where('product_id', $product->id)
                ->whereNotIn('id', $data['current_images'])
                ->delete();
        }
        else {
            ProductImage::where('product_id', $product->id)->delete();
        }
        if (isset($data['files'])){
            foreach($request->file('files') as $key => $file) {
                ProductImage::create([
                    'image' =>  Helpers::saveImage($file,'product',370,390),
                    'product_id' => $product->id
                ]);

            }

        }

        $product->save();



        return redirect()->route('admin.products.index')->with('success', 'Продукт обновлен!');
    }
}
