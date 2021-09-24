<?php

namespace local_morris\filters;

class additional implements \local_morris\interfaces\filters_interface{

	protected $arguments;

	/**
	 * filters_interface constructor.
	 * @param array $arguments
	 */
	public function __construct(array $arguments = []){
		$this->arguments = $arguments;
	}

	/**
	 * Apply the filter of the instance to the collection
	 * @param array $collection
	 * @return array
	 */
	public function applyTo(array $collection){

		$filtered = [];
		foreach($collection as $item){
			if($item->source == 'ext'){
				$filtered[] = $item;
			}
		}

		return $filtered;
	}
}