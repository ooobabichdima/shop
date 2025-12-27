<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    */

    'novaposhta' => [
        'api_key' => env('NOVAPOSHTA_API_KEY'),
        'mode' => env('NOVAPOSHTA_MODE', 'sandbox'),
        'cache_ttl' => env('NOVAPOSHTA_CACHE_TTL', 86400),
    ],

    'monobank' => [
        'token' => env('MONO_TOKEN'),
        'webhook_secret' => env('MONO_WEBHOOK_SECRET'),
        'mode' => env('MONO_MODE', 'sandbox'),
        'redirect_url' => env('MONO_REDIRECT_URL'),
        'webhook_url' => env('MONO_WEBHOOK_URL'),
    ],

];
