<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;

class AssignDriverRequest extends Request
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
      'driver_id' =>'required|numeric|unique:driver_vehicle,driver_id,NULL,id,vehicle_id, '.Input::get('vehicle_id')
    ];
  }
}
