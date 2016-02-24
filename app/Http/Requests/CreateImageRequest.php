<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;
use Auth;

class CreateImageRequest extends Request
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
         'name' => 'alpha_num | required | unique:user_images',
         'mobile_image_name' => 'alpha_num | required | unique:user_images',
         'is_active' => 'boolean',
         'is_featured' => 'boolean',
         'image' => 'required | mimes:jpeg,jpg,bmp,png | max:5000',
         'mobile_image' => 'required | mimes:jpeg,jpg,bmp,png | max:5000'
     ];
    }
}
