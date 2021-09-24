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
 * Strings for component 'auth_ef_webbog_sso', language 'da'
 *
 * @package   auth_ef_webbog_sso
 * @author Henrik Sune Pedersen
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$string['auth_nonedescription'] = 'Users can sign in and create valid accounts immediately, with no authentication against an external server and no confirmation via email.
Be careful using this option - think of the security and administration problems this could cause.';
$string['pluginname'] = 'ef/webbog -login';
$string['auth_ef_webbog_sso_secret'] = 'SSO ef/webbog -login Secret';




$string['auth_ef_webbog_sso_test'] = 'SSO ef/webbog plugin';
$string['auth_ef_webbog_ssodescription'] = "SSO til webbogen";
$string['pluginname'] = 'ef/webbog -sso';
$string['auth_sign-out_with'] = "Log af ef/webbog -C";
$string['no_user_in_moodle'] = "Brugeren er ikke oprettet i moodle eller der er forsøgt logget ind med forkert bruger <a href='https://login.emu.dk/?logout_action=1&two=IGNORER&one=sso.emu.dk'>Gå til ef/webbog -login og forsøg igen</a>";
$string['timestampused'] = "Timestamp fejl - Brugeren er ikke oprettet i moodle eller der er forsøgt logget ind med forkert bruger <a href='https://login.emu.dk/?logout_action=1&two=IGNORER&one=sso.emu.dk'>Gå til ef/webbog -login og forsøg igen</a>";

$string['auth_ef_webbog_ssokey'] = 'Nøglen skal være den samme for både afsender og modtager';
$string['auth_ef_webbog_ssokey_key'] = 'ef/webbog Nøgle (key)';
$string['auth_ef_webbog_ssoiv'] = 'IV er aftalt i ef/webbog team';
$string['auth_ef_webbog_ssoiv_key'] = 'ef/webbog - initialization vector (IV).';

$string['displaylogin'] = 'Aktiver redirect';
$string['displayloginhelp'] = '
Hvis dette er valgt vil besøgende blive sendt direkte til ef/webbog -login og man vil ikke se den almindelige moodle login side. Man kan dog altid se login siden ved at gå til
"mitwebsted/login/index.php?ef_webbog_sso=no"';

$string['displaylogout'] = 'Redirect directly to ef/webbog -logout';
$string['displaylogouthelp'] = 'If this option is set, then the user is logged out of ef/webbog -login as well as moodle when logging out.';

$string['auth_ef_webbog_ssosettings'] = 'Indstillinger';
$string['couldnotauthenticate'] = 'Login fejlet - Prøv at logge ind igen.';
$string['couldnotgetgoogleaccesstoken'] = 'Der er sendt en kommunikations fejl fra ef/webbog -C. Prøv at logge ind igen.';
$string['couldnotauthenticateuserlogin'] = 'Login fejl.<br/>
Prøv venligst igen, med brugernavn og password.<br/>
<br/>
<a href="{$a->loginpage}">Prøv igen</a>.<br/>
<a href="{$a->forgotpass}">ar du glemt dit password </a>?';
$string['ef_webbog_ssodisplaybuttons'] = 'Vis ef/webbog -login knapper';
$string['ef_webbog_ssodisplaybuttonshelp'] = 'Vis ef/webbog -login knappen på login siden, sammen med det normale login. For at dette virker optimalt, sæt da "Force users to login" i sitepolicies';
$string['emailaddressmustbeverified'] = 'Din email adresse er ikke verificeret. ';
$string['auth_sign-in_with'] = 'Log ind med  {$a->providername}';
$string['signinwithanaccount'] = 'Log ind med:';
$string['noaccountyet'] = 'Du har ikke rettigheder til at se siden. Kontakt venligst en administrator.';
$string['unknownfirstname'] = 'Ukendt fornavn';
$string['unknownlastname'] = 'Ukendt efternavn';
$string['show_moodle_login'] = 'Klik her for Moodle bruger login';
$string['moodlelogin'] = 'Gem Moodle login formularen bag et link';
$string['moodleloginhelp']= 'Gem Moodle login formularen, som kommer frem igen ved klik på et link';
