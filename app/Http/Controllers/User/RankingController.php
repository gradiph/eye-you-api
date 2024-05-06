<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Test;

class RankingController extends Controller
{
    public function index(Test $test) {
        $results = $test->results()
            ->with('user')
            ->orderBy('score', 'desc')
            ->orderBy('created_at', 'asc')
            ->simplePaginate(5);
        return response()->json([
            'results' => $results,
        ]);
    }
}
