<?php

return [
    'merchant_id' => env('MIDTRANS_MERCHANT_ID'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'server_key' => env('MIDTRANS_SERVER_KEY'),

    // Set to true for Production Environment (accept real transaction).
    'is_production' => env('APP_ENV') === 'production',

    // Set 3DS transaction for credit card to true
    'is_3ds' => true,

    // Set sanitization on (default)
    'is_sanitized' => true,
];
