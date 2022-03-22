<?php

return [

    'credentials'       => [
        'default'   => [
            'mode'        => env('DURIANPAY_MODE', 'development'),
            'api_key'     => env('DURIANPAY_API_KEY', ''),
        ],
    ],

];
