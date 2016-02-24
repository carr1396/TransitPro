<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;

class UpdatePostRequest extends Request
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
             'slug' =>['required', 'unique:posts,slug,'.$this->route('blog')],
             'published_at' =>['date_format:Y-m-d H:i:s'],
             'body' =>['required']
         ];
     }
}
