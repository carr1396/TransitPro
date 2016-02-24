<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;
use Auth;

class StoreLocationRequest extends Request
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
          'name' =>['unique:locations', 'required'],
          'latitude' =>['required', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
          'longitude' =>['required', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
          'address' =>['required'],
          'district_id' =>['required', 'numeric']
        ];
    }
}
