<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\Achievement;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $user = new User;
        $user->name = $request->username;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->avatar = $request->avatar ?? '/user-default.png';
        $user->save();

        return response()->json([
            'user' => $user,
        ]);
    }
    
    public function login(UserLoginRequest $request)
    {
        /** @var User */
        $user = User::where('username', $request->username)
            ->first();
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['Password is incorrect']
            ]);
        }

        $token = $user->createToken('user-token', ['user']);
        if (is_null($user->achievements()->find(Achievement::FIRST_LOGIN))) {
            $user->achievements()->attach(Achievement::FIRST_LOGIN);
        }

        return response()->json([
            'token' => $token->plainTextToken
        ]);
    }
}
