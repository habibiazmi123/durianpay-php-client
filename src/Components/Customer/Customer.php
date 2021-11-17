<?php

namespace ZerosDev\Durianpay\Components\Customer;

use BadMethodCallException;
use ZerosDev\Durianpay\Traits\SetterGetter;

class Customer
{
	use SetterGetter;

	public function __construct() {
		
	}

	public function toArray() {
		$properties = [];
		foreach (get_object_vars($this) as $name => $value) {
			if (! is_object($value)) {
				$properties[$name] = $value;
			} else {
				if (! method_exists($value, 'toArray')) {
					throw new BadMethodCallException('Call to undefined method '.get_class($value).'::toArray()');
				}
				$properties[$name] = $value->toArray();
			}
		}

		return $properties;
	}
}