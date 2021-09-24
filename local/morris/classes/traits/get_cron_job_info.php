<?php

namespace local_morris\traits;

use external_function_parameters;
use external_multiple_structure;
use external_single_structure;
use external_value;

trait get_cron_job_info{

	/**
	 * @return external_function_parameters
	 */
	public static function get_cron_job_info_parameters(){
		return new external_function_parameters([]);
	}

	/**
	 * Returns a list of all cronjobs
	 */
	public static function get_cron_job_info(){
		global $DB;
		self::validate_parameters(self::get_cron_job_info_parameters(), []);

		$cron_job_info = new \local_morris\cron_job_info();
		return $cron_job_info->enhance($DB->get_records('task_scheduled'));
	}

	/**
	 * @return external_multiple_structure
	 */
	public static function get_cron_job_info_returns(){
		return new external_multiple_structure(
			new external_single_structure([
				'id' => new external_value(PARAM_INT, 'The Moodle id of the cronjob'),
				'component' => new external_value(PARAM_TEXT, 'The plugin where the cronjob belongs'),
				'classname' => new external_value(PARAM_TEXT, 'The class of the cronjob'),
				'lastruntime' => new external_value(PARAM_TEXT, 'A unix timestamp'),
				'nextruntime' => new external_value(PARAM_TEXT, 'A unix timestamp'),
				'blocking' => new external_value(PARAM_INT, 'An integer representing if the cronjob should block other jobs'),
				'minute' => new external_value(PARAM_TEXT, 'A character representing standard cron timings for minutes'),
				'hour' => new external_value(PARAM_TEXT, 'A character representing standard cron timings for hours'),
				'day' => new external_value(PARAM_TEXT, 'A character representing standard cron timings for days'),
				'month' => new external_value(PARAM_TEXT, 'A character representing standard cron timings for months'),
				'dayofweek' => new external_value(PARAM_TEXT, 'A character representing standard cron timings for days of week'),
				'faildelay' => new external_value(PARAM_INT, ''),
				'customised' => new external_value(PARAM_INT, 'Does the settings differ from the default?'),
				'disabled' => new external_value(PARAM_INT, 'Determines if the cronjob or the plugin is disabled'),
				'disabled_message' => new external_value(PARAM_TEXT, 'A short text to display in Morris, to determine if the plugin is disabled or the cronjob is directly disabled.'),
			])
		);
	}
}