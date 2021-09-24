<?php

namespace local_morris\mocks;

class task{

	protected $run_if_component_disabled;

	public function __construct($run_if_component_disabled = true){
		$this->run_if_component_disabled = $run_if_component_disabled;
	}

	public function get_run_if_component_disabled(){
		return $this->run_if_component_disabled;
	}
}