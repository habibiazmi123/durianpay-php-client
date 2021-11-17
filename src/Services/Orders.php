<?php

namespace ZerosDev\Durianpay\Services;

use ZerosDev\Durianpay\Client;
use ZerosDev\Durianpay\Constant;
use ZerosDev\Durianpay\Traits\SetterGetter;

class Orders
{
	use SetterGetter;
	
	public function __construct(Client $client) {
		$this->client = $client;
	}

	public function create() {
		$this->client->setRequestPayload([
			"amount" => $this->getAmount() ? $this->getAmount().".00" : null,
			"payment_option" => $this->getPaymentOption(),
			"currency" => $this->getCurrency(),
			"order_ref_id" => $this->getOrderRefId(),
			"customer" => $this->getCustomer(Constant::ARRAY),
			"items"	=> $this->getItems(Constant::ARRAY),
			"metadata" => $this->getMetadata(Constant::ARRAY)
		]);
		
		return $this->client->post('orders');
	}

	public function fetch(string $id = null) {
		if ($id) {
			return $this->client->get('orders/'.$id);
		}

		$query = http_build_query([
			'from'	=> $this->getFrom(),
			'to'	=> $this->getTo(),
			'skip'	=> $this->getSkip(),
			'limit'	=> $this->getLimit(),
		]);

		return $this->client->get('orders'.($query ? '?'.$query : ''));
	}
}