<?php

namespace local_morris;

class core implements interfaces\core{


	/**
	 * $task = \core\task\manager::get_scheduled_task($cronjob->classname);
	 * @param $classname
	 * @return mixed
	 */
	public function get_task($classname){
		return \core\task\manager::get_scheduled_task($classname);
	}

	/**
	 * $component = $task->get_component();
	 * @param $task
	 * @return mixed
	 */
	public function get_component($task){
		return $task->get_component();
	}

	/**
	 *
	 * @param $component
	 * @return mixed
	 */
	public function get_plugin_info($component){
		return \core_plugin_manager::instance()->get_plugin_info($component);
	}
}