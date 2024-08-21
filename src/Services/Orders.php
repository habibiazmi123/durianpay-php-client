<?php

namespace ZerosDev\Durianpay\Services;

use ZerosDev\Durianpay\Client;
use ZerosDev\Durianpay\Constant;
use ZerosDev\Durianpay\Traits\SetterGetter;

class Orders
{
    use SetterGetter;

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function create()
    {
        $payload = [
            'amount' => $this->getAmount(),
            'payment_option' => $this->getPaymentOption('full_payment'),
            'currency' => $this->getCurrency('IDR'),
            'order_ref_id' => $this->getOrderRefId(),
        ];

        if ($customer = $this->getCustomer()) {
            $payload['customer'] = $customer->toArray();
        }

        if ($items = $this->getItems()) {
            $payload['items'] = $items->toArray();
        }

        if ($metadata = $this->getMetadata()) {
            $payload['metadata'] = $metadata->toArray();
        }

        if ($expiryDate = $this->getExpiryDate()) {
            $payload['expiry_date'] = $expiryDate;
        }

        $this->client->setRequestPayload($payload);

        return $this->client->request('orders', 'POST', Constant::CONTENT_JSON);
    }

    public function fetch()
    {
        if ($this->getId()) {
            return $this->client->request('orders/'.$this->getId());
        }

        $query = http_build_query([
            'from'	=> $this->getFrom(),
            'to'	=> $this->getTo(),
            'skip'	=> $this->getSkip(),
            'limit'	=> $this->getLimit(),
        ]);

        return $this->client->request('orders'.($query ? '?'.$query : ''));
    }
}
