<?php
function authenticate($user, $password) {
	
	// Active Directory server
	$ldap_host = "192.168.140.42";

	// Active Directory DN
	$ldap_dn = "dc=afdb,dc=local";

	// Active Directory user group
	$ldap_user_group = "WebUsers";

	// Active Directory manager group
	$ldap_manager_group = "WebManagers";

	// Domain, for purposes of constructing $user
	$ldap_usr_dom = "@afdb.org";

	// connect to active directory
	$ldap = ldap_connect($ldap_host);

	// verify user and password
	if($bind = @ldap_bind($ldap, $user . $ldap_usr_dom, $password)) {
		// valid
		// check presence in groups
		$filter = "(sAMAccountName=" . $user . ")";
		$attr = array("memberof");
		$result = ldap_search($ldap, $ldap_dn, $filter, $attr) or exit("Unable to search LDAP server");
		$entries = ldap_get_entries($ldap, $result);
		ldap_unbind($ldap);

		// check groups
		foreach($entries[0]['memberof'] as $grps) {
			// is manager, break loop
			if (strpos($grps, $ldap_manager_group)) { $access = 2; break; }

			// is user
			if (strpos($grps, $ldap_user_group)) $access = 1;
		}

		if ($access != 0) {
			// establish session variables
			$_SESSION['user'] = $user;
			$_SESSION['access'] = $access;
			echo"true";
			return true;
		} else {
		echo"false";
			// user has no rights
			return false;
		}

	} else {
		// invalid name or password
		return false;
	}
}
?>
