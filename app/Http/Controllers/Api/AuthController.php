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
        $old_user = User::where('email', $request->email)->first();

        if (isset($old_user)) {
            return response()->json(['failure' => ['User cannot be created'], 400], 400);
        }
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->is_Admin = $request->is_Admin;
        $user->password = Hash::make($request->password);
        $user->api_token = Str::random(80);
        $user->save();

        return response()->json(['user' => [$user], 200], 200);

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'User has been logged out.',
        ]);
    }

}
