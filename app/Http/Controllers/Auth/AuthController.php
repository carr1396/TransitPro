<?php

namespace TransitPro\Http\Controllers\Auth;

use TransitPro\User;
use TransitPro\Role;
use Validator;
use TransitPro\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    private $maxLoginAttempts = 10;


    public function __construct()
    {
        $this->redirectAfterLogout=route('auth.login');
        // $this->redirectTo=route('backend.dashboard');
        $this->redirectTo='/';
        $this->middleware('guest', ['except' => 'getLogout']);
    }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'other_names' => 'max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
       $otherNames = $data['other_names']?:'';
       $display_name = $data['first_name'] .' '.$otherNames.' '.$data['last_name'];
       $user =User::create([
          'first_name' => $data['first_name'],
          'last_name' => $data['last_name'],
          'other_names'=>$data['other_names'],
          'email' => $data['email'],
          'display_name'=>$display_name,
          'password' =>$data['password'],
        ]);
      $this->syncRoles($data, $user);
      return $user;
    }

    protected function syncRoles(array $request, $user)
    {
        if (in_array('roles', $request)) {
            $user->roles()->sync(array_keys($request->roles));
        } else {
            $default=Role::where('name', 'customer')->first();
            if($default){
              $user->attachRole($default);
            }else{
              $user->roles()->sync([]);
            }
        }
    }
}
