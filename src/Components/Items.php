<?php

namespace ZerosDev\Durianpay\Components;

use ZerosDev\Durianpay\Constant;
use ZerosDev\Durianpay\Traits\SetterGetter;

class Items
{
    use SetterGetter;

    public function __construct()
    {
    }

    public function add($name, $price, $quantity, $logoUrl)
    {
        $this->addItems([
            'name' => $name,
            'price' => strval($price),
            'qty' => $quantity,
            'logo' => $logoUrl
        ]);
    }

    public function toArray()
    {
        return $this->getItems();
    }
}
