<?php
$container = $app->getContainer();

// Services

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings');
    $logger = new \Monolog\Logger($settings['logger']['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['logger']['path'], \Monolog\Logger::DEBUG));
    return $logger;
};

// Controller Service Definition
$container['RS\Framework\Controller\HomeAction'] = function ($c) {
    return new RS\Framework\Controller\HomeAction(
        new RS\Timer\Timer(),
        $c->get('logger')
    );
};
