<?php

namespace App\Http\Controllers;

use App\Http\Requests\Achievement\StoreRequest;
use App\Http\Requests\Achievement\UpdateRequest;
use App\Models\Achievement;
use Illuminate\Support\Facades\Log;

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
        $path = $request->file('image')->storePublicly('public/images');
        
        $achievement = new Achievement();
        $achievement->id = $request->id;
        $achievement->name = $request->name;
        $achievement->image = $path;
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
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storePublicly('public/images');
            $achievement->image = $path;
        }
        
        $achievement->name = $request->name;
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
