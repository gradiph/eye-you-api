<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return response()->json([
            'user' => Auth::user(),
        ]);
    }

    public function update(UpdateRequest $request)
    {
        /** @var User */
        $user = Auth::user();
        $user->name = $request->name;

        if ($request->has('password')) {
            $user->password = $request->password;
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storePublicly('public/images');
            if ($path) {
                $user->avatar = str_replace('public', 'storage', $path);
            }
        }
        $user->save();
        return response()->json([
            'user' => $user,
        ]);
    }
}
