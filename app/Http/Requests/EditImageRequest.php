<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;
use Auth;
class EditImageRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     public function authorize()
     {
         return Auth::check();
     }

     public function forbiddenResponse(){
       return redirect()->back()->withErrors([
         'error' =>'You DO Not Have Permission To Perform This Action'
       ]);
     }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
     'is_active' => 'boolean',
     'is_featured' => 'boolean',
     'image' => 'mimes:jpeg,jpg,bmp,png | max:5000',
     'mobile_image' => 'mimes:jpeg,jpg,bmp,png | max:5000'
 ];
    }
}
