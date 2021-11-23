<?php

namespace ZerosDev\Durianpay\Services;

use ZerosDev\Durianpay\Client;
use ZerosDev\Durianpay\Constant;
use ZerosDev\Durianpay\Traits\SetterGetter;

class Payments
{
    use SetterGetter;

    private $type;
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function charge()
    {
        $payloads = [
            "type"	=> strtoupper($this->getType()),
        ];

        if ($request = $this->getRequest()) {
            $payload['request'] = $request->toArray();
        }

        switch ($payloads['type']) {
            case "VA":
                if (
                    is_object($request)
                    && ($request->getBankCode() === "BCA")
                    && ($customer_info = $this->getCustomerInfo())
                ) {
                    $payloads['customer_info'] = $customer_info->toArray();
                }
                break;

            case "ONLINE_BANKING":
                if ($customer_info = $this->getCustomerInfo()) {
                    $payloads['customer_info'] = $customer_info->toArray();
                }
                $payloads['mobile'] = $this->getMobile();
                break;
        }

        $this->client->setRequestPayload($payloads);

        return $this->client->request('payments/charge', 'POST', Constant::CONTENT_JSON);
    }

    public function fetch()
    {
        if ($this->getId()) {
            return $this->client->request('payments/'.$this->getId());
        }

        $query = http_build_query([
            'from'	=> $this->getFrom(),
            'to'	=> $this->getTo(),
            'skip'	=> $this->getSkip(),
            'limit'	=> $this->getLimit(),
        ]);

        return $this->client->request('payments'.($query ? '?'.$query : ''));
    }

    public function status()
    {
        if (! $this->getId()) {
            return false;
        }
        return $this->client->request('payments/'.$this->getId().'/status');
    }

    public function verify(string $signature)
    {
        if (! $this->getId()) {
            return false;
        }
        return $this->client->request('payments/'.$this->getId().'/verify?verification_signature='.$signature);
    }

    public function cancel()
    {
        if (! $this->getId()) {
            return false;
        }
        return $this->client->request('payments/'.$this->getId().'/cancel');
    }
}
