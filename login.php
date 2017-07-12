<?php
require_once('inserts/ErrorReporting.php');
$casNetid ='cwalters';
//require_once('assets/cas.php');
//getCAS();

session_start();

//remove PHPSESSID from browser
if ( isset( $_COOKIE[session_name()] ) )
setcookie( session_name(), "", time()-3600, "/" );
//clear session from globals
$_SESSION = array();
//clear session from disk
session_destroy();
?>
<?php

if (!$casNetid) exit("direct access not permitted");


// Connect to server and select database.
 require_once('inserts/setUpDB.php');
		DB::$error_handler = false; // since we're catching errors, don't need error handler
		DB::$throw_exception_on_error = true;

		try {

		   	$sql_result = DB::queryFirstRow("select * from tblemployees where UID = '$casNetid' LIMIT 1");
		    $ldap_result = ldapAuthentication($casNetid);

		    DB::disconnect(); // drop mysqli connection

			if(session_id() == ''){
				//session has not started
				session_start();
				}
					$_SESSION['fullName'] = $ldap_result['fullName'];
					$_SESSION['firstName'] = $ldap_result['firstName'];
					$_SESSION['lastName'] = $ldap_result['lastName'];
					$_SESSION['email'] = $ldap_result['email'];
					$_SESSION['sessCustomerID'] = $_SESSION['username'] = $casNetid;
					$_SESSION['title'] = $ldap_result['title'];
		      $_SESSION['telephone'] = $sql_result['Telephone'];
		      $_SESSION['office'] = $ldap_result['office'];
		      $_SESSION['approver_group'] = $sql_result['GroupID'];
		      $_SESSION['CreditLevel'] = $sql_result['CreditLevel'];
					$_SESSION['logged_in'] = true;
          $_SESSION['UserLevel'] = $level = $sql_result['UserLevel'];


    switch ($level) {
		  case 0:
		    header( 'Location: dashboard.php' );
		    break;
		  case 2:
		    header( 'Location: receiving.php' );
		    break;
		  case 3:
		    header( 'Location: approverdashboard.php' );
		    break;
		 case 5:
		    header( 'Location: admindashboard.php' );
		    break;
		 default:
		    header( 'Location: dashboard.php' );
		    break;
		}


 } catch(MeekroDBException $e) {
  echo "Error: " . $e->getMessage() . "<br>\n"; // something about duplicate keys
  echo "SQL Query: " . $e->getQuery() . "<br>\n"; // INSERT INTO accounts...
}

// restore default error handling behavior
// don't throw any more exceptions, and die on errors
DB::$error_handler = 'meekrodb_error_handler';
DB::$throw_exception_on_error = false;

?>
<?php
  /* LDAP Code begin */
    function ldapAuthentication($username) {
    	$ldap      = array('ldaphost' => 'ldap://ldap.umd.edu',
			'domain'   => 'umd.edu',
			'dn'       => 'ou=people,dc=umd,dc=edu',
			'binduser' => 'uid=chem-requisition-purchasing,cn=auth,ou=ldap,dc=umd,dc=edu',
			'bindpass' => '37gx3JI8Wwevky5KZNDD8ZT2'
    	);

		// Open LDAP connection to server
		$ldapconn  = ldap_connect($ldap['ldaphost']);
		//ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		//ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);

		// Bind with binduser as proxy to do the search
		$proxyBind         = ldap_bind($ldapconn, $ldap['binduser'], $ldap['bindpass']);

		if (!$proxyBind) {
			return "[invalidLDAPProxy]";
		}

		// search for the supplied username in the base DN
		$ldapSearchResult = ldap_search($ldapconn, $ldap['dn'], "(uid=".$username.")" , array( "*" ));

		$ldapEntries = ldap_get_entries($ldapconn, $ldapSearchResult);

		if ($ldapEntries["count"] < 1) {
			return null;
		}


		$user_info = array();
		$user_info['fullName'] = $ldapEntries[0]["givenname"][0]." ".$ldapEntries[0]["sn"][0];
		$user_info['email']    = $ldapEntries[0]["mail"][0];
		$user_info['firstName'] = $ldapEntries[0]["givenname"][0];
		$user_info['lastName'] = $ldapEntries[0]["sn"][0];
		$user_info['title'] = $ldapEntries[0]["title"][0];
		$user_info['telephone'] = $ldapEntries[0]["telephoneNumber"][0];
		$user_info['office'] = $ldapEntries[0]["postalAddress"][0];

		ldap_unbind($ldapconn);

		return $user_info;
    }
    /* LDAP Code end */

    /*image from Google*/



?>
