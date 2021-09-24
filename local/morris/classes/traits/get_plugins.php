<?php

namespace local_morris\traits;

use core_plugin_manager;
use external_function_parameters;
use external_multiple_structure;
use external_single_structure;
use external_value;

trait get_plugins{

	/**
	 * @return external_function_parameters
	 */
	public static function get_plugins_parameters(){
		return new external_function_parameters([]);
	}

	/**
	 * Returns a list of all cronjobs
	 */
	public static function get_plugins(){
		self::validate_parameters(self::get_plugins_parameters(), []);

		$plugin_manager = core_plugin_manager::instance();
		$plugins = new \local_morris\plugins($plugin_manager);
		return $plugins->all();
	}

	/**
	 * @return external_multiple_structure
	 */
	public static function get_plugins_returns(){
		return new external_multiple_structure(
			new external_single_structure([
				'type' => new external_value(PARAM_TEXT, 'The type of the plugin'),
				'typerootdir' => new external_value(PARAM_TEXT, 'The root directory of the type, of the plugin'),
				'name' => new external_value(PARAM_TEXT, 'The system name of the plugin'),
				'displayname' => new external_value(PARAM_TEXT, 'The name displayed to the user'),
				'enabled' => new external_value(PARAM_BOOL, 'Is the plugin enabled'),
				'source' => new external_value(PARAM_TEXT, 'The source of the plugin ext = External / Additional'),
				'rootdir' => new external_value(PARAM_TEXT, 'The root directory of the plugin itself'),
				'versiondisk' => new external_value(PARAM_TEXT, 'The version installed on the disk'),
				'versiondb' => new external_value(PARAM_TEXT, 'The version installed in the database'),
				'versionrequires' => new external_value(PARAM_TEXT, 'The version of Moodle required by the plugin'),
				'release' => new external_value(PARAM_TEXT, 'The release of the plugin (human readable)'),
				'dependencies' => new external_multiple_structure(
					new external_single_structure([
						'name' => new external_value(PARAM_TEXT, 'Other plugins that this plugin is dependable on'),
						'version' => new external_value(PARAM_TEXT, 'Other plugins that this plugin is dependable on'),
					])
				)
			])
		);
	}
}
