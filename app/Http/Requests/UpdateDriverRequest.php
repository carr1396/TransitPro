<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;
use Auth;

class UpdateDriverRequest extends Request
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
        'license' => 'required|max:255|alpha_dash|unique:drivers,license,'.$this->route('drivers'),
        'user_id' => 'required|integer|unique:drivers,user_id,'.$this->route('drivers'),
      ];
    }
}
