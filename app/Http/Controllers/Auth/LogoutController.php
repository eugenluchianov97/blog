<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Http\RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return Redirect()->route('login');
    }
}
