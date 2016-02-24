<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;

class StorePageRequest extends Request
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
             'title' =>['required'],
             'name' =>['unique:pages'],
             'uri' =>['required', 'unique:pages'],
             'content' =>['required']
         ];
     }
}
