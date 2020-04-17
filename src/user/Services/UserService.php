<?php

namespace User\Services;

use Illuminate\Support\Facades\Auth;

use User\Models\User;

class UserService
{
    public function register($credentials)
    {
        return User::create($credentials);
    }

    public function login($credentials)
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            $tokenResult = $user->createToken('Token');

            return [
                'token_type' => 'Bearer',
                'access_token' => $tokenResult->accessToken,
            ];
        }

        return null;
    }
}
