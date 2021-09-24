<?php

namespace local_morris\filters;

class filter{

	/**
	 * @param $filters
	 * @param $collection
	 * @return array
	 * @throws \Exception
	 *
	 * $filters could look something like this:
	 *
	 * $filters[] = 'additional';
	 *
	 * OR
	 *
	 * $filters[] = [
	 *     'name' => 'additional',
	 *     'args' => null
	 * ];
	 *
	 * OR
	 *
	 * $filter = new StdClass();
	 * $filter->name = 'additional';
	 * $filter->args = [];
	 * $filters[] = $filter;
	 *
	 */
	public static function add($filters, array $collection){

		foreach($filters as $filter){

			$info = self::normalize_filter($filter);
			$name = $info['name'];
			$args = $info['args'];

			$instance = static::make($name, $args);
			$collection = $instance->applyTo($collection);
		}

		return $collection;
	}

	/**
	 * @param $filter
	 * @return array
	 * @throws \Exception
	 */
	protected static function normalize_filter($filter){
		if(is_string($filter)){
			return [
				'name' => $filter,
				'args' => [],
			];
		}
		elseif(is_array($filter) && !empty($filter['name'])){

			if(isset($filter['args']) && !is_array($filter['args'])){
				throw new \Exception('$filter[\'args\'] can only be an array');
			}

			return [
				'name' => $filter['name'],
				'args' => $filter['args'],
			];
		}
		elseif(is_object($filter) && !empty($filter->name)){

			if(isset($filter->args) && !is_array($filter->args)){
				throw new \Exception('$filter[\'args\'] can only be an array');
			}

			return [
				'name' => $filter->name,
				'args' => $filter->args,
			];
		}

		throw new \Exception('Unable to parse filters');
	}

	/**
	 * @param $filter
	 * @return mixed
	 * @throws \Exception
	 */
	protected static function make($filter, $arguments = []){

		if(!file_exists(__DIR__.'/'.$filter.'.php')){
			throw new \Exception('Filter not valid - unknown filter "'.$filter.'"');
		}

		$class = '\\'.__NAMESPACE__.'\\'.$filter;
		return new $class($arguments);
	}

}