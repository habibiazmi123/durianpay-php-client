<?php

namespace ZerosDev\Durianpay;

use Exception;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\TransferStats;
use Carbon\Carbon;
use ZerosDev\Durianpay\Traits\SetterGetter;

class Client
{
	use SetterGetter;

	protected $http;
	protected $api_key;
	protected $request_endpoint;
	protected $request_url;
	protected $request_method;
	protected $request_payload = [];
	protected $request_headers = [];
	protected $response;

	public function __construct(string $api_key = null) {
		$this->setApiKey($api_key);
		$this->setRequestHeaders([
			'Authorization'		=> 'Basic '.base64_encode($this->getApiKey().":"),
			'Accept'			=> 'application/json'
		]);
		$self = $this;
		$this->http = new GuzzleClient([
			'base_uri'		=> Constant::URL_API,
			'http_errors' 	=> false,
			'headers'		=> $this->getRequestHeaders(),
			'on_stats' => function (TransferStats $s) use (&$self) {
		        $self->setRequestUrl(strval($s->getEffectiveUri()));
		    }
		]);
	}

	public function post($endpoint) {
		$this->setRequestEndpoint($endpoint);
		$this->setRequestMethod('POST');
		$this->addRequestHeaders('Content-Type', 'application/json');

		try {
			$response = $this->http->post($endpoint, [
				'json'	=> $this->getRequestPayload(),
			])
			->getBody()
			->getContents();

		} catch (Exception $e) {
			$response = $e->getMessage();
		}

		$this->setResponse($response);

		return $this->getResponse();
	}

	public function debugs() {
		return [
			'url'	=> $this->getRequestUrl(),
			'method' => $this->getRequestMethod(),
			'payload' => $this->getRequestPayload(),
			'headers' => $this->getRequestHeaders(),
			'response' => $this->getResponse(),
		];
	}
}