<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;
use Auth;
class UpdateVehicleRequest extends Request
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
      'make' => 'required|max:255',
      'model' => 'required|max:255',
      'year' => 'required|required|date_format:Y|before:next year',
      'capacity' => 'required|numeric|min:1',
      'registration_number' => ['required', 'max:255', 'unique:vehicles,registration_number,'.$this->route('vehicles'), 'alpha_dash'],
      'number_plate' => ['required', 'max:255', 'unique:vehicles,number_plate,'.$this->route('vehicles'), 'alpha_dash'],
      'vehicle_number' => ['max:255', 'unique:vehicles,vehicle_number,'.$this->route('vehicles'), 'alpha_num'],
      'type' => 'required',
      'active' => 'boolean'
    ];
  }
}
