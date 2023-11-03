<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(LoginRequest $request)
    {
        $data = $request->validated();


        if(!Auth::attempt($data)) {
            return redirect()->back()->with('invalid_credentials', 'Invalid credentials!');
        }
        return redirect()->route('admin.index')->withSuccess('You have Successfully loggedin');

    }
}
