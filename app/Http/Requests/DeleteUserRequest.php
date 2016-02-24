<?php

namespace TransitPro\Http\Requests;

use TransitPro\Http\Requests\Request;

class DeleteUserRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->route('users')== auth()->user()->id){
            return false;
        }else{
          return true;
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
            //
        ];
    }
}
