<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user)
            ],
            'password' => 'sometimes|nullable|min:8|confirmed',
            'role' => 'required|in:super_admin,admin,outlet_incharge',
            'outlet_id' => 'nullable|exists:outlets,id'
        ];
    }
}
