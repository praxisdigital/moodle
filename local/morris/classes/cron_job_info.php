<?php

namespace local_morris;

class cron_job_info{

	/**
	 * Gets all cronjobs from the database and parse through them and set if the plugin is disabled amongst other things.
	 * @param $cronjobs
	 * @return array
	 */
	public function enhance($cronjobs){
		$enhanced_jobs = [];
		foreach($cronjobs as $cronjob){
			$cronjob_status = $this->is_disabled($cronjob, new core);
			$cronjob->disabled = $cronjob_status->disabled;
			$cronjob->disabled_message = $cronjob_status->message;

			$enhanced_jobs[] = $cronjob;
		}

		return $enhanced_jobs;
	}

	/**
	 * @param $cronjob
	 * @param interfaces\core $core
	 * @return object
	 */
	public function is_disabled($cronjob, interfaces\core $core){
		if($cronjob->disabled === 1){
			return (object)[
				'disabled' => 1,
				'message' => 'Cronjob is manually disabled'
			];
		}

		$task = $core->get_task($cronjob->classname);
		$component = $core->get_component($task);
		$plugininfo = $core->get_plugin_info($component);

		if (!empty($plugininfo) && $plugininfo->is_enabled() === false && !$task->get_run_if_component_disabled()) {
			return (object)[
				'disabled' => 1,
				'message' => 'Plugin for cronjob is disabled'
			];
		}

		return (object)[
			'disabled' => 0,
			'message' => 'Cronjob is active'
		];
	}

	/**
	 * Converts a unix timestamp to a DateTime object
	 * @param $unix_timestamp
	 * @return \DateTime|null
	 */
	public function convert_to_datetime($unix_timestamp){
		if($unix_timestamp === 0){
			return null;
		}

		$date = new \DateTime('now', new \DateTimeZone('Europe/Copenhagen'));
		$date->setTimestamp($unix_timestamp);
		return $date;
	}
}