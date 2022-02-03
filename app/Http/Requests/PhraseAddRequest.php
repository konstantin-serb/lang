<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhraseAddRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'section_id' => 'required|integer',
            'phrase' => 'required|min:2|max:256',
            'translate' => 'required|min:2|max:256',
            'transcription' => 'nullable|max:256'
        ];
    }
}















