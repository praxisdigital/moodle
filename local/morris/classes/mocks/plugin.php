<?php

namespace local_morris\mocks;

class plugin{

	protected $is_enabled;
	protected $data;

	public function __construct($attributes = []){
		$this->data = $attributes;
	}

	public function __get($key){
		if(isset($this->data[$key])){
			return $this->data[$key];
		}

		throw new \Exception('Unknown property '.$key.' on class '.__CLASS__);
	}

	public function is_enabled(){
		return $this->is_enabled;
	}
}