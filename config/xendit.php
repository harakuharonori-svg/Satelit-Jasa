<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Xendit API Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for Xendit payment gateway.
    | Make sure to set your API keys in the .env file.
    |
    */

    'api_key' => env('XENDIT_API_KEY'),
    
    'base_url' => env('XENDIT_BASE_URL', 'https://api.xendit.co'),
    
    'webhook_token' => env('XENDIT_WEBHOOK_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Payment Methods Configuration
    |--------------------------------------------------------------------------
    */
    
    'payment_methods' => [
        'qris' => [
            'enabled' => true,
            'type' => 'QR_CODE',
            'channel_code' => 'QRIS',
        ],
        'virtual_account' => [
            'enabled' => true,
            'banks' => [
                'bca' => 'BCA',
                'bni' => 'BNI', 
                'bri' => 'BRI',
                'cimb' => 'CIMB',
            ]
        ],
        'ewallet' => [
            'enabled' => true,
            'channels' => [
                'ovo' => 'OVO',
                'dana' => 'DANA',
                'linkaja' => 'LINKAJA',
                'shopeepay' => 'SHOPEEPAY',
            ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Settings
    |--------------------------------------------------------------------------
    */
    
    'currency' => 'IDR',
    'country' => 'ID',
    'success_redirect_url' => env('APP_URL') . '/payment/success',
    'failure_redirect_url' => env('APP_URL') . '/payment/failed',
    'webhook_url' => env('APP_URL') . '/webhook/xendit',

];
