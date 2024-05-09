<?php

namespace App\Http\Requests\User\Game;

use App\Models\Result;
use App\Models\ResultQuestion;
use Illuminate\Foundation\Http\FormRequest;

class SubmitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $resultQuestion = ResultQuestion::find($this->id);
        return $resultQuestion->result->user_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => 'required|exists:App\Models\ResultQuestion,id',
            'answer' => 'required',
        ];
    }
}
