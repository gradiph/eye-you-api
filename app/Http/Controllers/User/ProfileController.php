<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        /** @var User */
        $user = Auth::user();
        $user->load([
            'achievements',
        ]);
        return response()->json([
            'user' => $user,
        ]);
    }

    public function update()
    {

    }
}
