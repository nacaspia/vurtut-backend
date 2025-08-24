<?php
return [

    'credentials' => [
        'file' => base_path(env('FIREBASE_CREDENTIALS', 'config/firebase_credentials.json')),
    ],

    // Burada yalnız string tipində project adı olmalıdır
    'default' => env('FIREBASE_PROJECT_ID', 'vurtut'),
];
