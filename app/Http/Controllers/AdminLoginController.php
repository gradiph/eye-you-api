<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AdminLoginRequest;
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
        $admin = Admin::where('username', $request->username)
            ->first();
        if (!Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'password' => ['Password is incorrect']
            ]);
        }

        $token = $admin->createToken('admin-token', ['admin']);

        return response()->json([
            'token' => $token->plainTextToken
        ]);
    }
}
