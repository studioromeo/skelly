<?php

require __DIR__ . '/../vendor/autoload.php';

// Instantiate the app
$settings = require __DIR__ . '/../src/config.php';
$app = new \Slim\App($settings);

// Set up dependencies
require __DIR__ . '/../src/services.php';

// Register middleware
require __DIR__ . '/../src/middleware.php';

// Register routes
require __DIR__ . '/../src/routes.php';

// Run!
$app->run();
