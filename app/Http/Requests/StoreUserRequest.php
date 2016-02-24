<?php

namespace TransitPro\Http\Requests;

use Auth;
use TransitPro\Http\Requests\Request;

class StoreUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
      return Auth::user()->canSetRolesOnNewUser(array_keys($this->get('roles', [])));
     }
     public function forbiddenResponse()
     {

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
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|confirmed|min:6',
      ];
    }
}
