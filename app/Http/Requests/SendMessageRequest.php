<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;

class SendMessageRequest extends Request
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
            'body'=>'required|email|max:255|min:30'
        ];
    }
}
