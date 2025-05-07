<?php

return [

    'credentials'       => [
        'default'   => [
            'base_url'    => env('DURIANPAY_BASE_URL', 'https://api.durianpay.id/v1/'),
            'mode'        => env('DURIANPAY_MODE', 'development'),
            'api_key'     => env('DURIANPAY_API_KEY', ''),
        ],
    ],

];
