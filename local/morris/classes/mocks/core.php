<?php

namespace local_morris\mocks;

class core implements \local_morris\interfaces\core{

	protected $task;
	protected $component;
	protected $plugin_info;

	public function __construct($task, $component, $plugin_info){
		$this->task = $task;
		$this->component = $component;
		$this->plugin_info = $plugin_info;
	}

	/**
	 * $task = \core\task\manager::get_scheduled_task($cronjob->classname);
	 * @param $classname
	 * @return mixed
	 */
	public function get_task($classname){
		return $this->task;
	}

	/**
	 * $component = $task->get_component();
	 * @param $task
	 * @return mixed
	 */
	public function get_component($task){
		return $this->component;
	}

	/**
	 *
	 * @param $component
	 * @return mixed
	 */
	public function get_plugin_info($component){
		return $this->plugin_info;
	}
}