<?php

namespace App\Http\Controllers;

use App\Http\Requests\Test\StoreRequest;
use App\Http\Requests\Test\UpdateRequest;
use App\Models\Test;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = Test::all();

        return response()->json([
            'tests' => $tests,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $test = new Test();
        $test->level_id = $request->level_id;
        $test->mode_id = $request->mode_id;
        $test->save();

        $test->load([
            'level',
            'mode',
        ]);
        
        return response()->json([
            'test' => $test,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        $test->load([
            'level',
            'mode',
        ]);

        return response()->json([
            'test' => $test,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Test $test)
    {
        $test->level_id = $request->level_id;
        $test->mode_id = $request->mode_id;
        $test->save();

        $test->load([
            'level',
            'mode',
        ]);
        
        return response()->json([
            'test' => $test,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        $test->load([
            'level',
            'mode',
        ]);

        $test->delete();
        
        return response()->json([
            'test' => $test,
        ]);
    }
}
