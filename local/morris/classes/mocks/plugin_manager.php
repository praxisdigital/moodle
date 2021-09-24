<?php

namespace local_morris\mocks;

class plugin_manager{

	protected $plugins;

	public function __construct($plugins = []){
		$this->plugins = $plugins;
	}

	public function get_plugins(){
		return $this->plugins;
	}

}