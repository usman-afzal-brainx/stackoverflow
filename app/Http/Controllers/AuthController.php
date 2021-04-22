<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required | string',
            'email' => 'required | string | unique:users,email',
            'password' => 'required | string| confirmed',
            'is_Admin' => 'required | String',
        ]);
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'is_Admin' => $fields['is_Admin'],
            'api_token' => Str::random(80),
        ]);
        return response($user, 200);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required | string',
            'password' => 'required | string',

        ]);

        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response(['message' => 'Credentials does not match'], 401);
        }

        return response($user->api_token, 200);
    }

    public function logout(Request $request)
    {
        auth('api')->user()->tokens()->delete();
        return response([
            'message' => 'User has been logged out.',
        ]);
    }

}
