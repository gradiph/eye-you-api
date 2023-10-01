<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mode;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function modes()
    {
        $modes = Mode::all();

        return response()->json([
            'modes' => $modes,
        ]);
    }

    public function selectMode(Request $request)
    {
        
    }
}
