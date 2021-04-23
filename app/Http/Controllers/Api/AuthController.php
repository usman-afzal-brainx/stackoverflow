<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
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
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('api_token')->plainTextToken;
            return response($token, 200);
        }

    }
    public function register(Request $request)
    {
        // $fields = $request->validate([
        //     'name' => 'required | string',
        //     'email' => 'required | string | unique:users,email',
        //     'password' => 'required | string| confirmed',
        //     'is_Admin' => 'required | String',
        // ]);
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'is_Admin' => request('is_Admin'),
            'api_token' => Str::random(80),
        ]);
        $credentials = $user->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $token = $request->user()->createToken('api_token')->plainTextToken;
            return response($token, 200);
        }
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'User has been logged out.',
        ]);
    }
    public function test()
    {
        return '1';
    }
}
