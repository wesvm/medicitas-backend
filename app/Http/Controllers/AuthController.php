<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request(['dni', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['error' => 'Bad credentials'], 401);
        }

        $user = Auth::user();
        $role = $user->rol;
        $token = Auth::claims(['role' => $role])->attempt($credentials);

        return $this->respondWithToken($token, $user);
    }

    public function me()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        Auth::logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::refresh(), Auth::user());
    }

    protected function respondWithToken($token, $user)
    {
        return response()->json([
            'account' => $user,
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 180
        ]);
    }
}
