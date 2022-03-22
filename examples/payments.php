<?php

require '../vendor/autoload.php';

use ZerosDev\Durianpay\Client;
use ZerosDev\Durianpay\Components\Request;

$apiKey = "your_api_key_here";
$mode = "development"; // "development" or "production"

$client = new Client($apiKey, $mode);

/**
 * Charge a payment/create payment code
 * */

$charge = $client->payments()
    ->setType('VA')
    ->setRequest(function (Request $request) {
        $request->setOrderId('ord_JGytr64yGj8')
            ->setBankCode('BRI')
            ->setName('Nama')
            ->setAmount(10000);
    })
    ->charge();

/**
 * Fetch all payments
 **/

$payments = $client->payments()->fetch();

/**
 * Fetch single payment by id
 **/

$fetch = $client->payments()->setId('pay_JGytr64yGj8')->fetch();