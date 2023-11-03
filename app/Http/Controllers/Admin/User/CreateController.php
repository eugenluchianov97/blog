<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $roles = Role::all();
        return view('admin.user.create',['roles' => $roles]);
    }
}
