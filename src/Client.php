<?php

namespace ZerosDev\Durianpay;

use Guzzlehttp\Client as GuzzleClient;
use Carbon\Carbon;

class Client
{
	protected $httpClient;
	protected $api_key;

	public function __construct(string $api_key = null) {
		$this->api_key = $api_key;
		$this->httpClient = new GuzzleClient([
			'base_uri'		=> Constant::URL_API,
			'http_errors' 	=> false,
			'headers'		=> [
				'Authorization'		=> 'Basic '.base64_encode($this->api_key.":"),
				'Accept'			=> 'application/json'
			]
		]);
	}

	
}