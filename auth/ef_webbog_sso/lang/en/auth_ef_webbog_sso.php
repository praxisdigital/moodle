<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'auth_ef_webbog_sso', language 'en'
 *
 * @package   auth_ef_webbog_sso
 * @author Henrik Sune Pedersen
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['auth_nonedescription'] = 'Users can sign in and create valid accounts immediately, with no authentication against an external server and no confirmation via email.
Be careful using this option - think of the security and administration problems this could cause.';
$string['pluginname'] = 'ef/webbog-login';
$string['auth_ef_webbog_sso_secret'] = 'SSO ef/webbog -login Secret';
$string['auth_ef_webbog_sso_test'] = 'SSO ef/webbog -login plugin';
$string['auth_ef_webbog_ssodescription'] = "SSO for ef/webbog -login";
$string['pluginname'] = 'ef/webbog -login';
$string['auth_sign-out_with'] = "Log off ef/webbog -login";
$string['no_user_in_moodle'] = "Theres not created a moodle user with this username yet";

$string['auth_ef_webbog_ssokey'] = 'The key us the same on sender/receiver end';
$string['auth_ef_webbog_ssokey_key'] = 'ef/webbog Key';
$string['auth_ef_webbog_ssoiv'] = 'The IV is agreed on off line with ef/webbog team';
$string['auth_ef_webbog_ssoiv_key'] = 'ef/webbog - initialization vector (IV).';



$string['displaylogin'] = 'Redirect directly to ef/webbog -login';
$string['displayloginhelp'] = 'If this option is chosen the users will be directed directly to ef/webbog -login and don’t go to moodle ordinary login page. You can always go to the login page by using your-domain/login/index.php?ef_webbog_sso=no and get the login option';

$string['displaylogout'] = 'Redirect directly to ef/webbog -logout';
$string['displaylogouthelp'] = 'If this option is set, then the user is logged out of ef/webbog -login as well as moodle when logging out.';



$string['auth_ef_webbog_ssosettings'] = 'Settings';
$string['couldnotauthenticate'] = 'The authentication failed - Please try to sign-in again.';
$string['couldnotgetgoogleaccesstoken'] = 'The authentication provider sent us a communication error. Please try to sign-in again.';
$string['couldnotauthenticateuserlogin'] = 'Authentication method error.<br/>
Please try to login again with your username and password.<br/>
<br/>
<a href="{$a->loginpage}">Try again</a>.<br/>
<a href="{$a->forgotpass}">Forgot your password</a>?';
$string['ef_webbog_ssodisplaybuttons'] = 'Display ef/webbog -login buttons on the login page, together with the normal login. For this to work porperly, set "Force users to login" in site policies';

$string['ef_webbog_ssodisplaybuttonshelp'] = 'Show the ef/webbog -login button on the login page above the normal login form';

$string['emailaddressmustbeverified'] = 'Your email address is not verified by the authentication method you selected. You likely have forgotten to click on a "verify email address" link that Google or Facebook should have sent you during your subscribtion to their service.';
$string['auth_sign-in_with'] = 'Sign-in with ef/webbog -login';
$string['moreproviderlink'] = 'Sign-in with another service.';
$string['signinwithanaccount'] = 'Log in with:';
$string['noaccountyet'] = 'You do not have permission to use the site yet. Please contact your administrator and ask them to activate your account.';
$string['unknownfirstname'] = 'Unknown Firstname';
$string['unknownlastname'] = 'Unknown Lastname';
$string['show_moodle_login'] = 'Login with you moodle user';
$string['moodlelogin'] = 'Hide Moodle login behind link';
$string['moodleloginhelp']= 'Hide the moodle user login form - Show it by clicking a link';