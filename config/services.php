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

    'facebook' => [
        'client_id' => '520376805543414',
        'client_secret' => 'bc2bfe68976bdd5b6903f43fa7ae2a14',
        'redirect' => 'http://system.brilliance-edu.org/',
    ],

    'google' => [
        'app_name' => 'Brilliance System',
        'client_id' => '350399918720-rmpdjglj0bhvlnvb5bahl9v4d4eu1sn9.apps.googleusercontent.com',
        'client_secret' => '6Is1fBSpvYSsmvwZVIbfgJkI',
        'api_key' => 'AIzaSyBr-3pFRzMBr6T6TZobFmDJKtG9retJBu4',
    ],

];
