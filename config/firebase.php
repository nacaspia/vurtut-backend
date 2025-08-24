<?php
return [
    'credentials' => [
        'file' => env('FIREBASE_CREDENTIALS'),
    ],

    'project_id' => env('FIREBASE_PROJECT_ID'),

    'database' => [
        'url' => env('FIREBASE_DATABASE_URL'),
    ],

    'storage' => [
        'default_bucket' => env('FIREBASE_STORAGE_BUCKET'),
    ],
];

