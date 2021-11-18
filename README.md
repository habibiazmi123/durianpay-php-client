<h1 align="center">durianpay-php-client</h1>
<h6 align="center"></h6>

<p align="center">
  <img src="https://img.shields.io/github/v/release/ZerosDev/durianpay-php-client?include_prereleases" alt="release"/>
  <img src="https://img.shields.io/github/languages/top/ZerosDev/durianpay-php-client" alt="language"/>
  <img src="https://img.shields.io/github/license/ZerosDev/durianpay-php-client" alt="license"/>
  <img src="https://img.shields.io/github/languages/code-size/ZerosDev/durianpay-php-client" alt="size"/>
  <img src="https://img.shields.io/github/downloads/ZerosDev/durianpay-php-client/total" alt="downloads"/>
  <img src="https://img.shields.io/badge/PRs-welcome-brightgreen.svg" alt="pulls"/>
</p>

## About

This library gives you an easy way to call DurianPay API in elegant code style. Example :

```php
Durianpay::orders()->fetch();
```

```php
Durianpay::payments()
    ->setType('VA')
    ->setRequest(function (Request $request) {
        $request->setOrderId('ord_JGytr64yGj8')
            ->setBankCode('XXX')
            ->setName('Nama Pelanggan')
            ->setAmount(10000);
    })
    ->charge()
```

## Installation

## Usage

### Laravel

### Non-Laravel
