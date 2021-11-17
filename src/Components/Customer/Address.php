<?php

namespace ZerosDev\Durianpay\Components\Customer;

use ZerosDev\Durianpay\Traits\SetterGetter;

class Address
{
	use SetterGetter;

	public function __construct() {

	}

	public function toArray() {
		return get_object_vars($this);
	}
}