<?PHP

    //exec ("sh ldap_dn.sh " . $_POST['user'],$output);
    //$ldaprdn = $output[0];
    $ldapusr = 'luiz_geraldo';
    $ldappass= 'as';
    $ldapini = substr($ldapusr,0,1); 

    echo ($ldapini);

    //if (empty($ldaprdn)){
        $ldaprdn = 'uid='.$ldapusr.',cn='.$ldapini.',cn=users,dc=sicredi,dc=com,dc=br';     // ldap rdn or dn
    //} 


 
    // using ldap bind
    //$ldapusr = $_POST['user'];
    $ldapini = substr($ldapusr,0,1); 

    // connect to ldap server
    //$ldapconn = ldap_connect("ldap-homolog.sicredi.net")
    $ldapconn = ldap_connect("ldap.sicredi.net") or die("Could not connect to LDAP server.");
    
    if ($ldapconn) {
			// binding to ldap server
			$ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);

			// verify binding
			if ($ldapbind) {
				echo "LDAP bind successful...";
				$expire=time()+60*60;
				setcookie("user", $ldapusr, $expire, "/"); 
				$_SESSION['login_user']=$ldapusr;

                header( 'Location: '.$APP_ROOT.'/');
                //header( 'Location: /admin/periodo');
                
			} else {
				echo "<br>LDAP bind failed...<br>";
            }
		}  
 
?>