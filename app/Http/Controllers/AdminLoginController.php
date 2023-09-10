<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLoginRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(AdminLoginRequest $request)
    {
        $credentials = $request->only([
            'username',
            'password',
        ]);

        $admin = Admin::findByUsername($credentials['username']);
        if (!Hash::check($credentials['password'], $admin->password)) {
            throw ValidationException::withMessages([
                'password' => ['Password is incorrect']
            ]);
        }

        $token = $admin->createToken('admin-token', ['admin']);

        return response()->json([
            'token' => $token
        ]);
    }
}
