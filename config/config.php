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

    'account_username' => env('SKYNET_ACCOUNT_USERNAME'),
    'account_password' => env('SKYNET_ACCOUNT_PASSWORD'),
    'system_id' => env('SKYNET_SYSTEM_ID'),
    'account_number' => env('SKYNET_ACCOUNT_NUMBER'),

    'prefix' => 'quote',
    'middleware' => ['web'],
];
