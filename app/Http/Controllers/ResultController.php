<?php

namespace App\Http\Controllers;

use App\Models\Result;

class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $results = Result::with([
            'user',
            'test.level',
            'test.mode',
        ])
            ->get();

        return response()->json([
            'results' => $results,
        ]);
    }
}
