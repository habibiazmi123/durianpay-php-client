<?php

require '../vendor/autoload.php';

use ZerosDev\Durianpay\Client;

$apiKey = "your_api_key_here";
$mode = "development"; // "development" or "production"

$client = new Client($apiKey, $mode);

/**
 * Bind e-wallet account
 */

$bind = $client->ewallet()
    ->setWalletType('DANA')
    ->setMobile('081234567890')
    ->bind();

/**
 * Unbind e-wallet account
 */

$unbind = $client->ewallet()
    ->setWalletType('DANA')
    ->setMobile('081234567890')
    ->unbind();

/**
 * Get e-wallet account detail
 */

$detail = $client->ewallet()
    ->setWalletType('DANA')
    ->setMobile('081234567890')
    ->accountDetail();
