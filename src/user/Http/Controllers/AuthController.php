<?php

namespace User\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use User\Http\Requests\LoginRequest;
use User\Http\Requests\RegisterRequest;
use User\Services\UserService;


class AuthController extends Controller
{
    protected $userService;

    public function __construct(
        UserService $userService
    ) {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        return $this->userService->register($request->validated());
    }

    public function login(LoginRequest $request)
    {
        $response = $this->userService->login($request->validated());

        if ($response) {
            return response()->json($response);
        }

        return response()->json([
            'message' => 'Unauthorized'
        ]);

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Logged out successfully'
        ], 200);
    }
}
