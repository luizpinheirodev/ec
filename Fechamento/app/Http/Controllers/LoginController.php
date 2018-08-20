<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use TarefaController;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


/*    public function __construct()
    {
        $this->middleware('auth');
    }
*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    public function loginLdap(Request $request){
        if($this->getLogin($request)){
            $user = \App\User::where('email', '=', $request->email)->first();
            //dd(count($user));
            if($user){
                \Auth::login($user);
                return redirect()->route('home');
            }else{
                $errors = [$this->username() => trans('auth.failed')];
                return \Redirect::back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors($errors);
            }
        }else{
            $errors = [$this->username() => trans('auth.failed')];
            return \Redirect::back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors($errors);
        }

    }

    public function username()
    {
        return 'email';
    }

    public function getLogin(Request $request){
        $ldapusr = $request->email;
        $ldappass= isset($request->password) ? $request->password : "ZZZ";
        $ldapini = substr($ldapusr,0,1); 
        $ldaprdn = 'uid='.$ldapusr.',cn='.$ldapini.',cn=users,dc=sicredi,dc=com,dc=br';     // ldap rdn or dn
        $ldapini = substr($ldapusr,0,1); 

        $ldapconn = ldap_connect("ldap.sicredi.net") or die("Could not connect to LDAP server.");
        
        if ($ldapconn) {
			$ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
			if ($ldapbind) {
//				echo "LDAP bind successful...";
				return true;
			} else {
                return false;
            }
		}  
    }




}
