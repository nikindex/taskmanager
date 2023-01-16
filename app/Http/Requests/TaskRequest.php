<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'title' => ['required', 'min:3'],
            'describe' => ['required', 'min:10'],
            'startTask' => ['required'],
            'endTask' => ['required','after:startTask'],
            'path_file'=> ['required','mimes:doc,txt,xls'],

        ];
    }
}
