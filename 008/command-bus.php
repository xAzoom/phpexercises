<?php

require_once __DIR__ . '/vendor/autoload.php';

use CommandBus\CommandBus;
use Commands\PingCommand;
use Commands\PongCommand;
use CommandsHandler\PingHandler;
use CommandsHandler\PongHandler;
use Exceptions\NoRouteFoundException;
use Routers\DirectRouter;

$router = new DirectRouter([
    PongCommand::class => function() {
        return new \CommandsHandler\EchoHandler("Pong");
    },
    PingCommand::class => function() {
        return new \CommandsHandler\EchoHandler("Ping");
    },
]);

$commandBus = new CommandBus($router);

try {
    $commandBus->dispatch(new PingCommand());
    $commandBus->dispatch(new PongCommand());
} catch (NoRouteFoundException $e) {
    echo $e->getMessage();
}

