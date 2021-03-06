<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;

class UpdateUserRequest extends Request
{
  /**
  * Determine if the user is authorized to make this request.
  *
  * @return bool
  */
  public function authorize()
  {
    if($this->route('users')== auth()->user()->id || Auth::user()->isAdmin()){
      return true;
    }else{
      return false;
    }

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
      'first_name' => 'required|max:255',
      'last_name' => 'required|max:255',
      'other_names' => 'max:255',
      'email' =>['required', 'email', 'unique:users,email,'.$this->route('users')],
      'password'=> ['required_with:password_confirmation', 'confirmed']//required only if input
    ];
  }
}
