<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;
use Auth;

class UpdateOrderRequest extends Request
{
  /**
  * Determine if the user is authorized to make this request.
  *
  * @return bool
  */
  public function authorize()
  {
    return Auth::check() && Auth::user()->isAdmin();

  }

  public function forbiddenResponse(){
    return redirect()->back()->withErrors([
      'error' =>'Action Forbidden You Might Be Trying To Delete Your Own Account'
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
      'address' => 'required|max:255',
      'phone' => 'required|max:255|regex:/^\+?[^a-zA-Z]{5,}$/',
      'phone2' => 'max:255|regex:/^\+?[^a-zA-Z]{5,}$/',
      'address2' => 'max:255',
      'start'=>'required|date|after:today',
      'end' => 'required|date|after:start_date',
    ];
  }
}
