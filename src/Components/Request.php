<?php

namespace ZerosDev\Durianpay\Components;

use ZerosDev\Durianpay\Traits\SetterGetter;

class Request
{
	use SetterGetter;

	public function __construct() {

	}

	public function toArray() {
		return get_object_vars($this);
	}
}