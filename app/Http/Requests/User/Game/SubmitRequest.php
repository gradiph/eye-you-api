<?php

namespace App\Http\Requests\User\Game;

use App\Models\Result;
use Illuminate\Foundation\Http\FormRequest;

class SubmitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $result = Result::find($this->resultId);
        return $result->user_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'resultId' => 'required|exists:App\Models\Result,id',
            'questionId' => 'required|exists:App\Models\Question,id',
            'answerId' => 'nullable|exists:App\Models\Answer,id',
        ];
    }
}
