<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Firebase Service Account
    |--------------------------------------------------------------------------
    |
    | Firebase Console → Project Settings → Service accounts
    | Oradan JSON faylını yüklə və /config/firebase_credentials.json kimi saxla.
    |
    */

    'credentials' => [
        'file' => base_path(env('FIREBASE_CREDENTIALS', 'config/firebase_credentials.json')),
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Project ID
    |--------------------------------------------------------------------------
    |
    | Firebase Project Settings → General tab → Project ID
    |
    */

    'default' => [
        'project_id' => env('FIREBASE_PROJECT_ID', 'vurtut'),
    ],
];
