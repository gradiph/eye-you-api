<?php

namespace App\Http\Requests\User\Game;

use Illuminate\Foundation\Http\FormRequest;

class StartRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'modeId' => 'required|exists:App\Models\Mode,id',
        ];
    }
}
