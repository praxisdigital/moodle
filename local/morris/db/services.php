<?php

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
 * @package    local_morris
 * @copyright  2018 Praxis - Erhvervsskolernes Forlag
 * @author     Ulrik McArdle
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// We defined the web service functions to install.
$functions = [
	'local_morris_get_cronjobinfo' => [
		'classname'     => 'local_morris_external',
		'methodname'    => 'get_cron_job_info',
		'classpath'     => 'local/morris/externallib.php',
		'description'   => 'Gets a list of all cronjobs and their current status',
		'type'          => 'read',
	],
	'local_morris_get_additional_plugins' => [
		'classname'     => 'local_morris_external',
		'methodname'    => 'get_additional_plugins',
		'classpath'     => 'local/morris/externallib.php',
		'description'   => 'Gets a list of additional plugins installed in Moodle',
		'type'          => 'read',
	],
	'local_morris_get_plugins' => [
		'classname'     => 'local_morris_external',
		'methodname'    => 'get_plugins',
		'classpath'     => 'local/morris/externallib.php',
		'description'   => 'Gets a list of all plugins installed in Moodle',
		'type'          => 'read',
	],
];
