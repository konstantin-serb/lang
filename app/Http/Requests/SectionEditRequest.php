<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionEditRequest extends FormRequest
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
            'title' => 'required|min:2|max:100',
            'description' => 'nullable|max:400'
        ];
    }


    public function messages()
    {
        return [
            'required' => 'Поле обязательно для заполнения',
            'min' => 'Минимум :min знаков',
            'max' => 'Максимум :max знаков',
        ];
    }
}
