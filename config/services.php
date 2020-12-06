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
        'redirect' => 'https://edu.marj3.com/auth/facebook/callback',
    ],

    'google' => [
        'client_id' => '502352632908-tt35ku5r0o2aa6iids8pi3732ub3pg76.apps.googleusercontent.com',
        'client_secret' => '7AzkuWWSoY0ZfaZT8RWOAk2P',
        'redirect' => 'https://edu.marj3.com/auth/google/callback',
    ],

];
