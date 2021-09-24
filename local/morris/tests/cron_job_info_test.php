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
 * Unit tests cron_job_info
 *
 * @package    local_morris
 * @category   phpunit
 * @copyright  2018 onwards Praxis - Erhvervsskolernes Forlag {@link https://praxis.dk}
 * @author     Ulrik McArdle
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

global $CFG;

/**
 *
 */
class cron_job_info_testcase extends advanced_testcase {

	/**
	 * Tests if the database flag "disabled" is set to 1
	 * @test
	 */
	public function is_cron_job_disabled_by_database_flag(){

		// Mockups
		// The plugin is enabled
		$mock_task = new \local_morris\mocks\task(false);
		$mock_plugin_info = new \local_morris\mocks\plugin_info(true);
		$mock_core = new \local_morris\mocks\core($mock_task, null, $mock_plugin_info);

		// The cron job is disabled (database flag set to 1)
		$mock_cron_job = new \local_morris\mocks\cron_job(1);

		$cron_job_info = new local_morris\cron_job_info();
		$cron_job = $cron_job_info->is_disabled($mock_cron_job, $mock_core);

		$this->assertEquals(1, $cron_job->disabled);
		$this->assertEquals('Cronjob is manually disabled', $cron_job->message);
	}

	/**
	 * Tests that if the plugin is disabled and the get_run_if_component_disabled is set to false
	 * the cron job status is set to disabled
	 * @test
	 */
	public function cron_job_is_disabled_by_the_plugin(){

		// Mockups
		// The plugin is disabled and get_run_if_component_disabled == false
		$mock_task = new \local_morris\mocks\task(false);
		$mock_plugin_info = new \local_morris\mocks\plugin_info(false);
		$mock_core = new \local_morris\mocks\core($mock_task, null, $mock_plugin_info);

		// The cron job is enabled in the database (database flag set to 0)
		$mock_cron_job = new \local_morris\mocks\cron_job(0);

		$cron_job_info = new local_morris\cron_job_info();
		$cron_job = $cron_job_info->is_disabled($mock_cron_job, $mock_core);

		$this->assertEquals(1, $cron_job->disabled);
		$this->assertEquals('Plugin for cronjob is disabled', $cron_job->message);
	}

	/**
	 * Tests that if the plugin is disabled and the get_run_if_component_disabled is set to true
	 * the cron job status is set to enabled
	 * @test
	 */
	public function cron_job_is_run_even_if_plugin_is_disabled(){

		// Mockups
		// The plugin is disabled and get_run_if_component_disabled == true
		$mock_task = new \local_morris\mocks\task(true);
		$mock_plugin_info = new \local_morris\mocks\plugin_info(false);
		$mock_core = new \local_morris\mocks\core($mock_task, null, $mock_plugin_info);

		// The cron job is enabled in the database (database flag set to 0)
		$mock_cron_job = new \local_morris\mocks\cron_job(0);

		$cron_job_info = new local_morris\cron_job_info();
		$cron_job = $cron_job_info->is_disabled($mock_cron_job, $mock_core);

		$this->assertEquals(0, $cron_job->disabled);
		$this->assertEquals('Cronjob is active', $cron_job->message);
	}

	/**
	 * Tests that if the plugin is enabled and the get_run_if_component_disabled is set to false
	 * the cron job status is set to enabled
	 * @test
	 */
	public function cron_job_is_run_if_not_disabled_at_all(){

		// Mockups
		// The plugin is disabled and get_run_if_component_disabled == true
		$mock_task = new \local_morris\mocks\task(false);
		$mock_plugin_info = new \local_morris\mocks\plugin_info(true);
		$mock_core = new \local_morris\mocks\core($mock_task, null, $mock_plugin_info);

		// The cron job is enabled in the database (database flag set to 0)
		$mock_cron_job = new \local_morris\mocks\cron_job(0);

		$cron_job_info = new local_morris\cron_job_info();
		$cron_job = $cron_job_info->is_disabled($mock_cron_job, $mock_core);

		$this->assertEquals(0, $cron_job->disabled);
		$this->assertEquals('Cronjob is active', $cron_job->message);
	}

}