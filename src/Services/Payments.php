<?php

namespace ZerosDev\Durianpay\Services;

use ZerosDev\Durianpay\Client;
use ZerosDev\Durianpay\Constant;
use ZerosDev\Durianpay\Traits\SetterGetter;

class Payments
{
    use SetterGetter;

    private $type;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function charge()
    {
        $payloads = [
            "type"	=> strtoupper($this->getType()),
            "request"	=> $this->getRequest(Constant::ARRAY),
        ];

        switch ($payloads['type']) {
            case "VA":
                if ($this->getRequest()->getBankCode() === "BCA") {
                    $payloads = array_merge($payloads, [
                        "customer_info"	=> $this->getCustomerInfo(Constant::ARRAY)
                    ]);
                }
                break;

            case "ONLINE_BANKING":
                $payloads = array_merge($payloads, [
                    "customer_info"	=> $this->getCustomerInfo(Constant::ARRAY),
                    "mobile" => $this->getMobile()
                ]);
                break;
        }

        $this->client->setRequestPayload($payloads);

        return $this->client->request('payments/charge', 'POST');
    }

    public function fetch()
    {
        if ($this->getId()) {
            return $this->client->get('payments/'.$this->getId());
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
