<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Game\StartRequest;
use App\Http\Requests\User\Game\SubmitRequest;
use App\Models\Achievement;
use App\Models\Answer;
use App\Models\Mode;
use App\Models\Question;
use App\Models\Result;
use App\Models\Test;
use App\Models\User;
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
            'test' => $test,
            'questions' => $questions,
        ]);
    }

    public function submit(SubmitRequest $request)
    {
        $resultId = $request->resultId;
        $questionId = $request->questionId;
        $answerId = $request->answerId;
        $answerText = $request->answerText;

        /** @var Result */
        $result = Result::find($resultId);
        /** @var Test */
        $test = $result->test;

        $question = $result->questions()->where('question_id', $questionId)->first();
        if (!is_null($question)) {
            Log::error("questionId [$questionId] is already answered for resultId [$resultId]");
            return response()->json([
                'success' => false,
            ]);
        }

        $question = $test->questions()->where('id', $questionId)->first();
        if (is_null($question)) {
            Log::error("questionId [$questionId] is not valid for resultId [$resultId]");
            return response()->json([
                'success' => false,
            ]);
        }

        $answer = null;
        if (!is_null($answerText)) {
            $answer = $question->answers()->where('alt_text', $answerText)->first();
            $result->questions()->attach($questionId, ['answer_id' => $answer?->id]);
        } else {
            $question = Question::whereHas('answers', function ($query) use ($answerId) {
                $query->where('id', $answerId);
            })->where('id', $questionId)->first();
            if (is_null($question)) {
                Log::error("answerId [$answerId] is not valid for questionId [$questionId]");
                return response()->json([
                    'success' => false,
                ]);
            }

            $answer = Answer::find($answerId);
            $result->questions()->attach($questionId, ['answer_id' => $answerId]);
        }
        
        $isCorrect = $answer?->is_correct ?? false;
        
        $totalQuestions = count($test->questions);
        $totalCorrectAnswers = 0;
        foreach ($result->questions as $question) {
            $answer = $question->pivot->answer;
            if ($answer?->is_correct ?? false) {
                $totalCorrectAnswers++;
            }
        }
        $result->score = 100 * $totalCorrectAnswers;
        $result->save();
        
        $totalScore = Result::where('user_id', auth()->id())->sum('score');
        /** @var User */
        $user = auth()->user();
        $user->total_score = $totalScore;
        $user->save();

        if ($totalQuestions == count($result->questions)) {
            if ($test->mode_id == Mode::NUMBER && is_null($user->achievements()->find(Achievement::FINISH_NUMBER_MODE))) {
                $user->achievements()->attach(Achievement::FINISH_NUMBER_MODE);
            } else if ($test->mode_id == Mode::SHAPE && is_null($user->achievements()->find(Achievement::FINISH_SHAPE_MODE))) {
                $user->achievements()->attach(Achievement::FINISH_SHAPE_MODE);
            }
        }

        if ($totalScore >= 500 && is_null($user->achievements()->find(Achievement::REACH_SCORE_500))) {
            $user->achievements()->attach(Achievement::REACH_SCORE_500);
        }

        if ($totalScore >= 1500 && is_null($user->achievements()->find(Achievement::REACH_SCORE_1500))) {
            $user->achievements()->attach(Achievement::REACH_SCORE_1500);
        }

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
        
        $totalQuestions = count($result->test->questions);
        $totalCorrectAnswers = 0;
        foreach ($result->questions as $question) {
            $answer = $question->pivot->answer;
            if ($answer?->is_correct ?? false) {
                $totalCorrectAnswers++;
            }
        }
        $totalWrongAnswers = $totalQuestions - $totalCorrectAnswers;
        $accuracy = $totalCorrectAnswers * 100 / $totalQuestions;
        
        $title = 'Mata Normal';
        $description = 'Kamu memiliki penglihatan mata normal, artinya kamu dapat melihat berbagai jutaan warna!';
        if ($accuracy >= 40 && $accuracy < 80) {
            $title = 'Buta Warna Sebagian';
            $description = 'Kamu mengalami sedikit gangguan dalam membedakan warna merah, hijau, dan biru.';
        } else if ($accuracy < 40) {
            $title = 'Buta Warna';
            $description = 'Kamu mengidap penyakit buta warna. Disarankan untuk menghubungi dokter ahli.';
        }

        return response()->json([
            'result' => $result,
            'analyzes' => [
                'total_questions' => $totalQuestions,
                'total_correct' => $totalCorrectAnswers,
                'total_wrong' => $totalWrongAnswers,
                'accuracy' => $accuracy,
                'title' => $title,
                'description' => $description,
            ],
        ]);
    }
}
