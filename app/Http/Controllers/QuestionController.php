<?php

namespace App\Http\Controllers;

use App\Http\Requests\Question\StoreRequest;
use App\Http\Requests\Question\UpdateRequest;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Test $test)
    {
        $questions = $test->questions;

        return response()->json([
            'questions' => $questions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Test $test)
    {
        $path = $request->file('image')->storePublicly('public/images');

        $question = new Question;
        $question->test_id = $test->id;
        $question->image = $path;
        $question->save();

        return response()->json([
            'question' => $question,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test, Question $question)
    {
        return response()->json([
            'question' => $question,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Test $test, Question $question)
    {
        $path = $request->file('image')->storePublicly('public/images');

        $question->image = $path;
        $question->save();

        return response()->json([
            'question' => $question,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test, Question $question)
    {
        $question->delete();
        
        return response()->json([
            'question' => $question,
        ]);
    }
}
