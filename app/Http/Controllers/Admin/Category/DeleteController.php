<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class DeleteController extends Controller
{

    public function __invoke(Category $category): \Illuminate\Http\RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно удалена!');
    }
}
