<?php

namespace App\Http\Controllers\Admin\User;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\IndexResource;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::latest()->paginate(10);

        return view('admin.user.index',['users' => $users]);
    }
}
