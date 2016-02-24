<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;
use Auth;

class UpdateTRouteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
     public function authorize()
     {
         return Auth::user()->isAdmin();
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
           'name' =>['unique:routes,name,'.$this->route('troutes'), 'required'],
           'start_location' =>['required', 'numeric'],
           'end_location' =>['required', 'numeric'],
           'active' =>['numeric'],
           'expectedDuration' =>['numeric']
         ];
     }
}
