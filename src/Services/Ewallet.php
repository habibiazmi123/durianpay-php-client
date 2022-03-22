<?php

namespace ZerosDev\Durianpay\Services;

use ZerosDev\Durianpay\Client;
use ZerosDev\Durianpay\Constant;
use ZerosDev\Durianpay\Traits\SetterGetter;

class Ewallet
{
    use SetterGetter;

    private $type;
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function bind()
    {
        $payloads = [
            "mobile" => $this->getMobile(),
            "wallet_type" => $this->getWalletType(),
        ];

        $this->client->setRequestPayload($payloads);
        $this->client->addRequestHeaders('Is-live', ($this->client->getMode() === 'production' ? 'true' : 'false'));

        return $this->client->request('ewallet/account/bind', 'POST', Constant::CONTENT_JSON);
    }

    public function unbind()
    {
        $payloads = [
            "mobile" => $this->getMobile(),
            "wallet_type" => $this->getWalletType(),
        ];

        $this->client->setRequestPayload($payloads);
        $this->client->addRequestHeaders('Is-live', ($this->client->getMode() === 'production' ? 'true' : 'false'));

        return $this->client->request('ewallet/account/unbind', 'POST', Constant::CONTENT_JSON);
    }

    public function accountDetail()
    {
        $payloads = [
            "mobile" => $this->getMobile(),
            "wallet_type" => $this->getWalletType(),
        ];

        $query = http_build_query($payloads);

        $this->client->addRequestHeaders('Is-live', ($this->client->getMode() === 'production' ? 'true' : 'false'));

        return $this->client->request('ewallet/account?'.$query, 'GET', Constant::CONTENT_JSON);
    }
}
