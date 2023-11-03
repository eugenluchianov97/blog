<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, User $user): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validated();
        $user->name = $data['name'];
        $user->email = $data['email'];

        if(!empty($data['password'])){
            $user->password = $data['password'];
        }
        $user->roles()->sync($data['roles']);

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Пользователь ' . $data['name'] .' обновлен!');;
    }
}
