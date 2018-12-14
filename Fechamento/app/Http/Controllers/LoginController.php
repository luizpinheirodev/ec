<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
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
        //$userSemLdap = ['luiz_geraldo', 'daniele_cruz', 'luis_mendes'];
        
        //$userSemLdap = \App\UserSemLdap::where('email', '=', $request->email)->first();
        
        /*if($userSemLdap){
            $user = \App\User::where('email', '=', $request->email)->first();
            if(Hash::check($request->password, $user->password)){
                \Auth::login($user);
                return redirect()->route('home');
            }else{
                $errors = [$this->username() => trans('auth.failed')];
                return \Redirect::back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors($errors);
            }                
        }else{*/
            if($this->getLogin($request)){
                $user = \App\User::where('email', '=', $request->email)->first();
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
        //}
    }

    public function username()
    {
        return 'email';
    }

    public function getLogin(Request $request){
        $ldapusr = $request->email;
        $ldappass= isset($request->password) ? $request->password : "ZZZ";

        

        //$ldapusr = 'luiz_geraldo';
        //$ldapconn = ldap_connect("openldap-slave.sicredi.net") or die("Could not connect to LDAP server.");
        $basedn="cn=users,dc=sicredi,dc=com,dc=br"; //even if it seems obvious I note here that the dn is just 
        //$filter="(samaccountname=$ldapusr)";

        $filter='(&(objectClass=inetOrgPerson)(uid='.$ldapusr.'))';  // single filter
        $attributes=array('dn','uid','sn');

        $cnx = ldap_connect('openldap-slave.sicredi.net',389); // single connection
        ldap_set_option($cnx, LDAP_OPT_PROTOCOL_VERSION, 3);

        $search = ldap_search(array($cnx,$cnx),$basedn,$filter,$attributes);  // search
        $entries = ldap_get_entries($cnx, $search[0]);  

        //dd($entries);

        $dn = $entries[0]['dn'];



        /*
        $filter = '(samaccountName='.$ldapusr.')';
        $attributes = array("name", "telephonenumber", "mail", "samaccountname");
        $result = ldap_search($ldapconn, $dn, $filter, $attributes);
        //$userDN = $entries[0]["name"][0];




        $sr = ldap_search($ldapconn, $dn,"$filter"); 
        $info = ldap_get_entries($connect, $sr); 



        $filter="(|(sn=$ldapusr*)(givenname=$ldapusr*))";
        

        $result = ldap_search($ldapconn, $dn, $filter);
        $info = ldap_get_entries($ldapconn, $result);
        dd($info);

        $res = ldap_search($ldapconn, $dn, '(|(samaccountname='.$ldapusr.'))');
        $first = ldap_first_entry($ldapconn, $res);
        dd($first);
        $data = ldap_get_dn($ldapconn, $first);

        dd($data);










        $ldapusr = 'viviane_silva';
        $ldapini = substr($ldapusr,0,1);
        //$ldaprdn = 'uid='.$ldapusr.',cn='.$ldapini.',cn=users,dc=sicredi,dc=com,dc=br';     // ldap rdn or dn
        $ldaprdn = 'uid='.$ldapusr.',cn=sicredi_servicos,cn=users,dc=sicredi,dc=com,dc=br';     // ldap rdn or dn
        //$ldapini = substr($ldapusr,0,1); 

        //$ldapconn = ldap_connect("ldap.sicredi.net") or die("Could not connect to LDAP server.");
        $ldapconn = ldap_connect("openldap-slave.sicredi.net") or die("Could not connect to LDAP server.");

        */
        
        if ($cnx) {
			//$ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
            $ldapbind = @ldap_bind($cnx, $dn, $ldappass);
            if ($ldapbind) {
//				echo "LDAP bind successful...";
				return true;
			} else {
                return false;
            }
		}  
    }




}
