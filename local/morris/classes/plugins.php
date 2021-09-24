<?php

namespace local_morris;

use local_morris\filters\filter;

class plugins{

	protected $plugin_manager;
	protected $plugins;

	/**
	 * plugins constructor.
	 * @param $plugin_manager
	 */
	public function __construct($plugin_manager){
		$this->plugin_manager = $plugin_manager;
		$this->adapt_plugins();
	}

	/**
	 * Returns a filtered collection for output in webservice. If you need more data, just add it here - this is used
	 * by all methods to control output.
	 * @return void
	 */
	protected function adapt_plugins(){

		$plugins = $this->plugin_manager->get_plugins();
		$adapted = [];
		foreach ($plugins as $plugin_type => $plugin_names) {
			foreach ($plugin_names as $plugin_name => $plugin_info) {

				$new_plugin_info = new \StdClass;
				$new_plugin_info->type = $plugin_info->type;
				$new_plugin_info->typerootdir = $plugin_info->typerootdir;
				$new_plugin_info->name = $plugin_info->name;
				$new_plugin_info->displayname = $plugin_info->displayname;
				$new_plugin_info->enabled = $plugin_info->is_enabled();
				$new_plugin_info->source = $plugin_info->source;
				$new_plugin_info->rootdir = $plugin_info->rootdir;
				$new_plugin_info->versiondisk = $plugin_info->versiondisk;
				$new_plugin_info->versiondb = $plugin_info->versiondb;
				$new_plugin_info->versionrequires = $plugin_info->versionrequires;
				$new_plugin_info->release = $plugin_info->release;
				$new_plugin_info->dependencies = $this->parse_dependencies($plugin_info->dependencies);

				$adapted[] = $new_plugin_info;
			}
		}

		$this->plugins = $adapted;
	}

	/**
	 * Converts key/value to multi dimensional array
	 * @param array $dependencies
	 * @return array
	 */
	protected function parse_dependencies($dependencies = []){
		$new_dependencies = [];
		foreach($dependencies as $name => $version){
			$new_dependencies[] = [
				'name' => $name,
				'version' => $version
			];
		}
		return $new_dependencies;
	}

	/**
	 * Returns an array with all plugins - filtered data
	 * @param array $filters
	 * @return array
	 * @throws \Exception
	 */
	public function all($filters = []){
		return filter::add($filters, $this->plugins);
	}

	/**
	 * Alias of all()
	 * @param array $filters
	 * @return array
	 * @throws \Exception
	 */
	public function filter($filters = []){
		return $this->all($filters);
	}

	/**
	 * Returns an array with all additional plugins - filtered data
	 * @param array $filters
	 * @return array
	 * @throws \Exception
	 */
	public function additional($filters = []){
		$filters[] = 'additional';
		return $this->all($filters);
	}
}