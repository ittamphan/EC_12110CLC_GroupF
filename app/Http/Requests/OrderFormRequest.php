<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrderFormRequest extends Request
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
            'phone' => 'numeric|min:10|required',
            'receiver_name' => 'min:5|required',
            'start_date' => 'date|date|date_format:Y-m-d',
            'received_date' => 'date|date_format:Y-m-d|after:start_date',
        ];
    }
}
