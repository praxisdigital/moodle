<?php

namespace local_morris\mocks;

class cron_job{
	public $disabled;

	public $classname;

	public function __construct($disabled = 0, $classname = ''){
		$this->disabled = $disabled;
		$this->classname = $classname;
	}
}