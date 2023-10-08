<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mode;
use App\Models\Test;
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

    public function start(Request $request)
    {
        $modeId = $request->modeId;

        $test = Test::where('mode_id', $modeId)
            ->inRandomOrder()
            ->first();
        $result = $test->results()->create([
            'user_id' => auth()->id(),
        ]);
        $questions = $test->questions()->with('answers')->get();

        return response()->json([
            'result' => $result,
            'questions' => $questions,
        ]);
    }
}
