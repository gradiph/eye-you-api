<?php

namespace App\Http\Requests\Answer;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'sometimes|file|mimetypes:image/jpeg,image/png',
            'alt_text' => 'required',
        ];
    }
}
