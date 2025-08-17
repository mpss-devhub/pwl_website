<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],


    'b2b' => [
        'secret_key' => env('B2B_SECRET_KEY'),
        'data_key' => env('B2B_DATA_KEY'),
        'register_url' => env('B2B_REGISTER_API_URL'),
        'update_url' => env('B2B_UPDATE_API_URL'),
        'external_url' => env('B2B_EXTERNAL_API_URL'),
        'external_url_2' => env('B2B_EXTERNAL_API_URL_2'),
        'x_app_id' => env('X_APP_ID'),
        'x_app_api_key' => env('X_APP_API_KEY'),
    ],

    'payment_gateway' => [
        'auth_token_url' => env('AUTH_TOKEN_API_URL'),
        'dopay_url' => env('DOPAY_API_URL'),
    ],

    'sms_poh' => [
        'api_url' => env('SMS_API_URL'),
    ],

];
