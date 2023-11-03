<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class DeleteController extends Controller
{

    public function __invoke(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Товар успешно удалена!');
    }
}
