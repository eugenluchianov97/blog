<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'. $this->user->id,
            'password' => 'nullable|min:6|confirmed',
            'password_confirmation' => 'nullable|min:6',
            'roles' => 'nullable'
        ];
    }
}
