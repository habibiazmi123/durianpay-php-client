<?php

namespace ZerosDev\Durianpay;

class HasSetter
{
	public function __call(string $method, $args = []) {
		if (strtolower(substr($method, 0, 3)) === 'set') {
			
		}
	}
}