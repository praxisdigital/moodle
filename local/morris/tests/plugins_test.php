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
class plugins_testcase extends advanced_testcase {

	/**
	 * Filters 2 out of 4, if half is additional plugins
	 * @test
	 */
	public function if_collection_of_four_and_only_two_are_additional_plugins_these_two_are_returned(){

		$default_fields = [
			'type' => '',
			'typerootdir' => '',
			'displayname' => '',
			'is_enabled' => '',
			'rootdir' => '',
			'versiondisk' => '',
			'versiondb' => '',
			'versionrequires' => '',
			'release' => '',
			'dependencies' => [],
		];

		$plugin1 = new local_morris\mocks\plugin(array_merge($default_fields, [
			'name' => 'plugin one',
			'source' => 'std'
		]));

		$plugin2 = new local_morris\mocks\plugin(array_merge($default_fields, [
			'name' => 'plugin two',
			'source' => 'ext'
		]));

		$plugin3 = new local_morris\mocks\plugin(array_merge($default_fields, [
			'name' => 'plugin three',
			'source' => 'std'
		]));

		$plugin4 = new local_morris\mocks\plugin(array_merge($default_fields, [
			'name' => 'plugin four',
			'source' => 'ext'
		]));

		$collection = [
			'plugin_type' => [
				'plugin one' => $plugin1,
				'plugin two' => $plugin2,
				'plugin three' => $plugin3,
				'plugin four' => $plugin4
			]
		];

		$plugin_manager = new \local_morris\mocks\plugin_manager($collection);
		$plugins = new \local_morris\plugins($plugin_manager);

		$additional_plugins = $plugins->additional();

		$this->assertCount(2, $additional_plugins);
		$this->assertEquals('plugin two', $additional_plugins[0]->name);
		$this->assertEquals('plugin four', $additional_plugins[1]->name);
	}

}