<?php

namespace local_morris\interfaces;

interface filters_interface{

	/**
	 * Apply the filter of the instance to the collection
	 * @param array $collection
	 * @return array
	 */
	public function applyTo(array $collection);

}