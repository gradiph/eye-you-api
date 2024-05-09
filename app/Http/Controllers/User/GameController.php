<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Game\StartRequest;
use App\Http\Requests\User\Game\SubmitRequest;
use App\Models\Achievement;
use App\Models\Mode;
use App\Models\Result;
use App\Models\ResultQuestion;
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
        $questions = collect();
        foreach ($test->levels as $testLevel) {
            $questions = $questions->merge(
                $testLevel->questions()
                    ->inRandomOrder()
                    ->take($testLevel->count)
                    ->get()
            );
        }
        $savedQuestions = $questions->map(function ($question) use ($result) {
            $resultQuestion = $result->questions()->create([
                'question_id' => $question->id,
                'image' => $question->image,
                'duration' => $question->duration,
                'correct_answer' => $question->answer,
                'score' => $question->testLevel->level->score,
            ]);
            $question->result_question_id = $resultQuestion->id;
            return $question;
        });

        return response()->json([
            'result' => $result,
            'test' => $test,
            'questions' => $savedQuestions,
        ]);
    }

    public function submit(SubmitRequest $request)
    {
        $id = $request->id;
        $answer = $request->answer;

        $resultQuestion = ResultQuestion::with(['result', 'question'])
            ->find($id);
        if (is_null($resultQuestion)) {
            Log::error('Invalid id', $request->all());
            return response()->json([
                'success' => false,
                'isCorrect' => false,
                'result' => null,
            ]);
        }

        $result = $resultQuestion->result;
        if (!is_null($resultQuestion->actual_answer)) {
            Log::error("The question is already answered.", [
                'request' => $request->all(),
                'resultQuestion' => $resultQuestion,
            ]);
            return response()->json([
                'success' => false,
                'isCorrect' => false,
                'result' => $result,
            ]);
        }

        $resultQuestion->actual_answer = $answer;
        if (!$resultQuestion->save()) {
            return response()->json([
                'success' => false,
                'isCorrect' => false,
                'result' => $result,
            ]);
        }
        
        $isCorrect = $resultQuestion->correct_answer == $answer;
        
        if ($isCorrect) {
            $result->score += $resultQuestion->score;
            $result->save();
        }
        
        $totalScore = Result::where('user_id', auth()->id())->sum('score');
        /** @var User */
        $user = auth()->user();
        $user->total_score = $totalScore;
        $user->save();

        $totalQuestions = $result->test->levels()->sum('count');
        $totalAnswered = count($result->questions);
        if ($totalQuestions == $totalAnswered) {
            $test = $result->test;
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
            'test.levels.questions',
            'questions',
        ]);
        
        $totalQuestions = count($result->test->questions);
        $totalCorrectAnswers = 0;
        foreach ($result->questions as $question) {
            if ($question->pivot->answer == $result->test->questions()->find($question->id)->answer) {
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
