<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // Set to false for production

        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../log/app.log',
        ],
    ],
];
