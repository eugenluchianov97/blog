<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{

    public function handle(Request $request, Closure $next): Response
    {
        $langPrefix = request()->segment(1, '');

        if($langPrefix && in_array($langPrefix,config('app.locales'))){
            App::setLocale($langPrefix);
        }
        return $next($request);
    }
}
