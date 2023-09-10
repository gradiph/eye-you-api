<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Achievement\StoreRequest;
use App\Http\Requests\Achievement\UpdateRequest;
use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::all();

        return response()->json([
            'achievements' => $achievements,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $args = $request->only([
            'name',
            'image',
        ]);

        $achievement = new Achievement();
        $achievement->name = $args['name'];
        $achievement->image = $args['image'];
        $achievement->save();

        return response()->json([
            'achievement' => $achievement,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Achievement $achievement)
    {
        return response()->json([
            'achievement' => $achievement,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Achievement $achievement)
    {
        $achievement->name = $request->name;
        $achievement->image = $request->image;
        $achievement->save();

        return response()->json([
            'achievement' => $achievement,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return response()->json([
            'achievement' => $achievement,
        ]);
    }
}
