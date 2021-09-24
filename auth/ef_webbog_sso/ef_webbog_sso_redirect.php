<?php

/*
 * Needed to add the parameter authprovider in order to identify the authentication provider
 */
require('../../config.php');
$code = optional_param('auth', '', PARAM_TEXT);



if (empty($code)) {
	
	throw new moodle_exception('ef_webbog_sso_failure');
}
    // Get ticket from return URL and check on own build checkinticket
    $ticket = $_GET['auth'];
    $secret = get_config('auth/ef_webbog_sso', 'ef_webbog_ssoclientsecret');
    $auth = md5($CFG->wwwroot .'/auth/ef_webbog_sso/ef_webbog_sso_redirect.php/appl'.$secret);
    $checkinticket = md5($_GET['timestamp'].$secret.$_GET['user']);
   
    // Ensure that this is no request forgery going on, and that the user
    // sending us this connect request is the user that was supposed to.
if ($ticket !== $checkinticket) {
	
	throw new moodle_exception('Invalid state parameter');
        
} else {
	
    // the user is good to go further
    // check and save the timestamp
    $table = 'auth_ef_webbog_sso';
    $select = "username = '".$_GET['user']."' AND timestamp = '".$_GET['timestamp']."' AND 1 = 1 "; //is put into the where clause
    $result = $DB->get_records_select($table,$select);
    // If the result is empty = the timestamp has not been used - moving on
    if(empty($result))
    {
        // Save the timestamp so it cannot be used again
        $record             = new stdClass();
        $record->username   = $_GET['user'];
        $record->timestamp  = $_GET['timestamp'];
        $lastinsertid = $DB->insert_record('auth_ef_webbog_sso', $record, false);

        // after timestamp is saved send test that the user is in DB in the moodle
        $table = 'user';
        $select = "username = '" . $_GET['user'] . "' AND 1 = 1 "; //is put into the where clause
        $result = $DB->get_record_select($table, $select);

        if(!empty($result))
        {
        	
        	$loginurl = '/login/index.php';
            if (!empty($CFG->alternateloginurl)) {
                $loginurl = $CFG->alternateloginurl;
//// Updated 10/02/2015
                $input = $loginurl."";
                
                // in case scheme relative URI is passed, e.g., //www.google.com/
                //$input = trim($input, '/');
                // If scheme not included, prepend it
                if (!preg_match('#^http(s)?://#', $input)) {
                	$input = 'http://' . $input;
                }
                $urlParts = parse_url($input);
                // remove www
                                
                $domain = preg_replace('/^www\./', '', $urlParts['host']);
                $domain .= $urlParts['path'];
               	$server = $_SERVER['SERVER_NAME'].'/';
                              
               if ($domain == $server)
               {
               	$loginurl = '/login/index.php';
               } 

                              
            }
            $url = new moodle_url($loginurl, array('code' => $ticket, 'authprovider' => 'ef_webbog_sso', 'user' => $_GET['user'], 'timestamp' => $_GET['timestamp'], 'wantsurl' => '/course/view.php?id=2'));
            redirect($url);
        }
        else
        {
            print_error('no_user_in_moodle', 'auth_ef_webbog_sso');
        }
    }
    else
    {

        echo "timestampused";
        print_error('timestampused', 'auth_ef_webbog_sso');
       // throw new moodle_exception('Timestamp er brugt af brugeren');
    }

}
?>
