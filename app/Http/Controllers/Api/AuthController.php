<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    // Register User
    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     $user = User::create([
    //         'nip' => $request->nip,
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     $token = JWTAuth::fromUser($user);

    //     return response()->json(['token' => $token], 201);
    // }

    // Login User
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }

    // Logout User
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Successfully logged out']);
    }

    // Get Authenticated User
    public function me()
    {
        return response()->json(Auth::user());
    }
}
