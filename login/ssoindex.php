<?php

require_once __DIR__.'/../config.php';

try{
    $bundleddata = required_param('bundleddata', PARAM_RAW);
    header('Location: /../auth/ef_webbog_sso/ssoindex.php?bundleddata='.$bundleddata);
    die();
}
catch(\Exception $e){
    if(debugging('', DEBUG_DEVELOPER)){
        debugging($e->getMessage(), DEBUG_DEVELOPER, debug_backtrace());
    }
    else{
        die(get_string('quiz_not_available', 'auth_ef_webbog_sso'));
    }
}
