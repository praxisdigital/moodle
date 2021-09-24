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
require_once $CFG->libdir . "/externallib.php";

class local_morris_external extends external_api{

	/**
	 * List all cronjobs
	 */
	use \local_morris\traits\get_cron_job_info;

	/**
	 * List all additional plugins installed on Moodle
	 */
	use \local_morris\traits\get_additional_plugins;

	/**
	 * List all plugins installed on Moodle
	 */
	use \local_morris\traits\get_plugins;

}