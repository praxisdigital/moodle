<?php

/**
 * @author Henrik Sune Pedersen
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package moodle multiauth
 *
 * Authentication Plugin: Uni-login Authentication
  * If the email exist (and the user has for auth plugin this current one),
 * then the plugin login the user related to this email.
 */
/*
if (!defined('MOODLE_INTERNAL')) {
    die('Direct access to this script is forbidden.');    ///  It must be included from a Moodle page
}*/
global $CFG;


require_once($CFG->libdir.'/authlib.php');

/**
 * Uni-login plugin.
 */
class auth_plugin_ef_webbog_sso extends auth_plugin_base {

    /**
     * Constructor.
     */
    function auth_plugin_ef_webbog_sso() {
        $this->authtype = 'ef_webbog_sso';
        $this->roleauth = 'auth_ef_webbog_sso';
        $this->errorlogtag = '[AUTH ef_webbog_sso] ';
        $this->config = get_config('auth/ef_webbog_sso');
    }


    /**
     * Returns true if this authentication plugin is 'internal'.
     *
     * @return bool
     */
    function is_internal() {
        return false;
    }

    /**
     * Returns true if this authentication plugin can change the user's
     * password.
     *
     * @return bool
     */
    function can_change_password() {
        return false;
    }

	function logoutpage_hook() {
                require_logout();
       }

    /**
     * Authentication hook - is called every time user hit the login page
     * The code is run only if the param code is mentionned.
     */
    function loginpage_hook() {




    }

    /**
     * Prints a form for configuring this authentication plugin.
     *
     * This function is called from admin/auth.php, and outputs a full page with
     * a form for configuring this plugin.
     *
     * some proper Moodle code. This code is similar to other auth plugins (04/09/11)
     *
     * @param array $page An object containing all the data for this page.
     */
    function config_form($config, $err, $user_fields) {
        global $OUTPUT, $CFG;

        // set to defaults if undefined
        if (!isset ($config->ef_webbog_ssokey)) {
            $config->ef_webbog_ssoclientid = '';
        }
        if (!isset ($config->ef_webbog_ssoiv)) {
            $config->ef_webbog_ssoiv = '';
        }


        echo '<table cellspacing="0" cellpadding="5" border="0">
            <tr>
               <td colspan="3">
                    <h2 class="main">';

        print_string('auth_ef_webbog_ssosettings', 'auth_ef_webbog_sso');
        echo '</h2>
               </td>
            </tr>';
        // ef_webbog_sso client id
        echo '<tr>
                <td align="left" style="min-width: 120px"><label for="ef_webbog_ssokey">';
        print_string('auth_ef_webbog_ssokey_key', 'auth_ef_webbog_sso');
        echo '</label></td><td>';
        echo html_writer::empty_tag('input',
            array('type' => 'text', 'id' => 'ef_webbog_ssokey', 'name' => 'ef_webbog_ssokey',
                'class' => 'ef_webbog_ssokey', 'value' => $config->ef_webbog_ssokey));
        if (isset($err["ef_webbog_ssokey"])) {
            echo $OUTPUT->error_text($err["ef_webbog_ssokey"]);
        }
        echo '</td><td>';
        print_string('auth_ef_webbog_ssokey', 'auth_ef_webbog_sso') ;
        echo '</td></tr>';
        echo '
            <tr>
               <td colspan="3">
                    <hr />
               </td>
            </tr>';


        // ef_webbog_sso client secret
        echo '<tr>
                <td align="left"><label for="ef_webbog_ssoiv">';
        print_string('auth_ef_webbog_ssoiv_key', 'auth_ef_webbog_sso');
        echo '</label></td><td>';
        echo html_writer::empty_tag('input',
            array('type' => 'text', 'id' => 'ef_webbog_ssoiv', 'name' => 'ef_webbog_ssoiv',
                'class' => 'ef_webbog_ssoiv', 'value' => $config->ef_webbog_ssoiv));
        if (isset($err["ef_webbog_ssoiv"])) {
            echo $OUTPUT->error_text($err["ef_webbog_ssoiv"]);
        }
        echo '</td><td>';
        print_string('auth_ef_webbog_ssoiv', 'auth_ef_webbog_sso') ;
        echo '</td></tr>';


        echo '
            <tr>
               <td colspan="3">
                    <hr /><br><br>
               </td>
            </tr>';

        echo '</table>';

    }

    /**
     * Processes and stores configuration data for this authentication plugin.
     */
    function process_config($config) {
        // set to defaults if undefined

        if (!isset ($config->ef_webbog_ssokey)) {
            $config->ef_webbog_ssokey = '';
        }
        if (!isset ($config->ef_webbog_ssoiv)) {
            $config->ef_webbog_ssoiv = '';
        }

        // save settings
        set_config('ef_webbog_ssokey', $config->ef_webbog_ssokey, 'auth/ef_webbog_sso');
        set_config('ef_webbog_ssoiv', $config->ef_webbog_ssoiv, 'auth/ef_webbog_sso');

        return true;
    }


}
