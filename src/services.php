<?php
$container = $app->getContainer();

// Services

// Database
$container['db'] = function ($container) {
    $c = $container->get('settings');

    $pdo = new PDO($c['db']['dsn'], $c['db']['user'], $c['db']['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
};

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

$container['RS\Framework\Controller\GetNodeTreeAction'] = function ($c) {
    return new RS\Framework\Controller\GetNodeTreeAction(
        new \RS\TreeBuilder\TreeBuilder(),
        $c->get('db')
    );
};
