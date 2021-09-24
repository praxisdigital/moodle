<?php

namespace local_morris\mocks;

class plugin_info{

	protected $is_enabled;

	public function __construct($is_enabled = true){
		$this->is_enabled = $is_enabled;
	}

	public function is_enabled(){
		return $this->is_enabled;
	}
}