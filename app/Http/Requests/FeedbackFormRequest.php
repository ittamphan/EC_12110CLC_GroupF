<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class FeedbackFormRequest extends Request
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
            'nickname' => 'min:6|required',
            'heading' => 'string|min:12|max:30|required',
            'content' => 'string|min:12|required'
        ];
    }
}
