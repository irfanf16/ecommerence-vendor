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
        'client_id'     => '988369485264734',
        'client_secret' =>'b86231601bced51d9ce2acbba9583c29',
        'redirect'      => 'http://localhost:8000/oauth/facebook/callback',
    ],

    'google' => [
        'client_id'     => '675119526244-vh96b468dm9e7fv7cnofgnh2ls8680ev.apps.googleusercontent.com',
        'client_secret' => 'Lhw8nScKpPne55AgKdNIIRn-',
        'redirect'      => 'http://localhost:8000/oauth/google/callback',
    ],


];