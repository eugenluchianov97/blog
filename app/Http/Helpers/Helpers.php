<?php

namespace App\Http\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Helpers {
    public static function saveImage($image, $dir,$width, $height){
        $img = Image::make($image)->fit($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->encode();
//        $img = Image::make($image)->fit($width, $height, function ($constraint) {
//            $constraint->aspectRatio();
//        })->encode();

        //$img = Image::make($image)->resize($width, $height)->encode();

        $originalName = $image->getClientOriginalName();

        $path = '/'.$dir.'/' . $originalName;

        Storage::disk('public')->put($path, $img);

        return '/storage' . $path;
    }

    public static function key($key){
        if(Config::get('app.fallback_locale') !== Config::get('app.locale')){
            return $key. '_'.Config::get('app.locale');
        }
        else {
            return $key;
        }

    }

}
