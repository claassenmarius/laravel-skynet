<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Skynet Account Credentials
    |--------------------------------------------------------------------------
    |
    | Here you can set your skynet account username, password, system id and
    | account number.
    */

    'account_username' => env('SKYNET_ACCOUNT_USERNAME', 'iDeliverTest'),
    'account_password' => env('SKYNET_ACCOUNT_PASSWORD', '!D3liver1!'),
    'system_id' => env('SKYNET_SYSTEM_ID', '2'),
    'account_number' => env('SKYNET_ACCOUNT_NUMBER', 'J99133'),

    'prefix' => 'quote',
    'middleware' => ['web'],
];
