<?php

namespace TransitPro\Http\Controllers\Auth;

use TransitPro\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{


    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->redirectTo = route('backend.dashboard');
        $this->redirectTo = '/';
        $this->middleware('guest');
    }
    protected function resetPassword($user, $password)
    {
        $user->password = $password;

        $user->save();

        Auth::login($user);
    }
    public function getReset(Request $request, $token = null)
    {
       return $this->showResetForm($request, $token);
    }

}
