<?php
namespace RS\Framework\Controller;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use RS\Timer\TimerInterface;

final class HomeAction
{
    private $logger;
    private $timer;

    public function __construct(TimerInterface $timer, LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->timer = $timer;
    }

    public function dispatch(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");

        $response->getBody()->write('The time is ' . $this->timer->getTime());
        return $response;
    }
}
