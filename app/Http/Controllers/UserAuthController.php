<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserAuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = new User;
        $user->name = $request->username;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        return response()->json([
            'user' => $user,
        ]);
    }
    
    public function login(UserLoginRequest $request)
    {
        $user = User::where('username', $request->username)
            ->first();
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Password is incorrect']
            ]);
        }

        $token = $user->createToken('user-token', ['user']);

        return response()->json([
            'token' => $token->plainTextToken
        ]);
    }
}
