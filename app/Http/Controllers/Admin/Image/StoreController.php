<?php

namespace App\Http\Controllers\Admin\Image;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Helpers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{

    public function __invoke(Request $request): string
    {
        $path = 'images/ajax/';

        $res = Storage::disk('public')->put($path, $request->file);
        return '/storage/'.ltrim($res,'/');
    }
}
