<?php
return [

    'credentials' => [
        'file' => base_path(env('FIREBASE_CREDENTIALS', 'config/firebase_credentials.json')),
    ],

    // Default project ID (string!)
    'default' => env('FIREBASE_PROJECT_ID', 'vurtut'),

    // Lazım gələrsə əlavə layihələr
    'projects' => [
        'vurtut' => [
            'credentials' => base_path(env('FIREBASE_CREDENTIALS', 'config/firebase_credentials.json')),
        ],
    ],
];
