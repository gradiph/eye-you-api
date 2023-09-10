<?php

namespace App\Http\Requests\Test;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'level_id' => 'required|exists:App\Models\Level,id',
            'mode_id' => 'required|exists:App\Models\Mode,id',
        ];
    }
}
