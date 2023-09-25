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
        'scheme' => 'https',
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

        'client_id' => '337839940049-vttb62h20o9ngsfigvriolp61q860c0t.apps.googleusercontent.com',

        'client_secret' => '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',

        'redirect' => 'http://localhost:8000/auth/google/callback',

    ],

    'facebook' => [
        'client_id' => '641285517824665',
        'client_secret' => '715bd9c512f9488975496abd3d9c30ed',
        'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],

];
