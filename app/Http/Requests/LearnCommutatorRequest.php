<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LearnCommutatorRequest extends FormRequest
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
            'cycles' => 'required|integer',
            'complexity' => 'required|integer',
            'sections' => 'nullable',
            'limit' => 'required|integer',
            'section' => 'required|integer',
            'sort' => 'required|integer',
            'task' => 'required|integer',
        ];
    }
}
