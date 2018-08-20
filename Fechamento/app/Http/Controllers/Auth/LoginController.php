<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->loginLDAP('guest');
        $this->middleware('guest')->except('logout');
    }

    /*public function loginLdap(Request $request){
        dd($request);
        if(\Auth::getLogin($request)){
            //dd("oi");
            $user = \App\User::where('email', '=', $request->email)->first();
            dd($user);
            Auth::login($user);
            redirect('/site');
        }

    }
    */
    


}
