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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '584249119143-ruhbfmboifako2ss7jnraecro9p7k6k5.apps.googleusercontent.com',
        'client_secret' => 'xt1CZmXr0Qaz7ruS7xmmaDEi',
        'redirect' => 'http://localhost/ecommerce/callback/google',
    ],
    'facebook' => [
        'client_id' => '500354884500557',
        'client_secret' => '771e8fd1a889495dad65ba65af73baf7',
        'redirect' => 'http://localhost/ecommerce/callback/facebook',
    ],
    

];
