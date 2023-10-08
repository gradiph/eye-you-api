<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Game\StartRequest;
use App\Http\Requests\User\Game\SubmitRequest;
use App\Models\Answer;
use App\Models\Mode;
use App\Models\Question;
use App\Models\Result;
use App\Models\Test;
use Illuminate\Support\Facades\Log;

class GameController extends Controller
{
    public function modes()
    {
        $modes = Mode::all();

        return response()->json([
            'modes' => $modes,
        ]);
    }

    public function start(StartRequest $request)
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

    public function submit(SubmitRequest $request)
    {
        $resultId = $request->resultId;
        $questionId = $request->questionId;
        $answerId = $request->answerId;

        $result = Result::find($resultId);

        $question = $result->questions()->where('question_id', $questionId)->first();
        if (!is_null($question)) {
            Log::error("questionId [$questionId] is already answered for resultId [$resultId]");
            return response()->json([
                'success' => false,
            ]);
        }

        $question = $result->test->questions()->where('id', $questionId)->first();
        if (is_null($question)) {
            Log::error("questionId [$questionId] is not valid for resultId [$resultId]");
            return response()->json([
                'success' => false,
            ]);
        }

        if (is_null(!$answerId)) {
            $question = Question::whereHas('answers', function ($query) use ($answerId) {
                $query->where('id', $answerId);
            })->where('id', $questionId)->first();
            if (is_null($question)) {
                Log::error("answerId [$answerId] is not valid for questionId [$questionId]");
                return response()->json([
                    'success' => false,
                ]);
            }
        }

        $result->questions()->attach($questionId, ['answer_id' => $answerId]);
        
        $answer = Answer::find($answerId);
        $isCorrect = $answer?->is_correct ?? false;
        
        $totalQuestions = count($result->test->questions);
        $totalCorrectAnswers = 0;
        foreach ($result->questions as $question) {
            $answer = $question->pivot->answer;
            if ($answer?->is_correct ?? false) {
                $totalCorrectAnswers++;
            }
        }
        $result->update([
            'score' => 100 * $totalCorrectAnswers / $totalQuestions,
        ]);

        return response()->json([
            'success' => true,
            'isCorrect' => $isCorrect,
            'result' => $result,
        ]);
    }

    public function result(Result $result) {
        $result->load([
            'test.questions.answers',
            'questions',
        ]);
        return response()->json([
            'result' => $result,
        ]);
    }
}
