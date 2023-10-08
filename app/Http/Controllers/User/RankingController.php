<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class RankingController extends Controller
{
    public function index() {
        $users = User::orderBy('total_score', 'desc')
            ->orderBy('updated_at', 'desc')
            ->simplePaginate(5);
        return response()->json([
            'users' => $users,
        ]);
    }
}
