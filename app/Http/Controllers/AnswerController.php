<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answer\StoreRequest;
use App\Http\Requests\Answer\UpdateRequest;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Test;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Test $test, Question $question)
    {
        $answers = $question->answers;

        return response()->json([
            'answers' => $answers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, Test $test, Question $question)
    {
        $path = $request->file('image')->storePublicly('public/images');
        
        $answer = new Answer();
        $answer->question_id = $question->id;
        $answer->image = $path;
        $answer->alt_text = $request->alt_text;
        $answer->save();

        return response()->json([
            'answer' => $answer,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test, Question $question, Answer $answer)
    {
        return response()->json([
            'answer' => $answer,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Test $test, Question $question, Answer $answer)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->storePublicly('public/images');
            $answer->image = $path;
        }
        
        $answer->alt_text = $request->alt_text;
        $answer->save();

        return response()->json([
            'answer' => $answer,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test, Question $question, Answer $answer)
    {
        $answer->delete();
        return response()->json([
            'answer' => $answer,
        ]);
    }
}
