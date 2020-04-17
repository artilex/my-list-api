<?php

namespace User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                'max:255',
                'exists:users',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
            ]
        ];
    }
}
