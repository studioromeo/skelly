<?php
$container = $app->getContainer();

// Middleware executed bottom to top
$app->add(new \Psr7Middlewares\Middleware\ResponseTime());
$app->add(new \Psr7Middlewares\Middleware\FormatNegotiator());
$app->add(new \Psr7Middlewares\Middleware\LanguageNegotiator(['en', 'de', 'cn', 'jp']));
//$app->add(new Psr7Middlewares\Middleware\AccessLog($container->get('logger')));
//$app->add(new Psr7Middlewares\Middleware\ClientIp());
