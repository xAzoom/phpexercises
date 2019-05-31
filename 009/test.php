<?php

use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\Plugin\Router\EventRouter;
use Storage\FileDB;

require_once __DIR__ . '/vendor/autoload.php';

$db = new FileDB();

$eventBus = new EventBus();
$eventRouter = new EventRouter();

$eventRouter->route(borrow\Event\BookReturned::class)
    ->to(new borrow\EventHandler\BookRentalSettled());

$eventRouter->attachToMessageBus($eventBus);

$process = new Process(["jeden", "dwa"], "processList",
                            $db, $eventBus, new \borrow\Event\BookReturned());
$process->handle("1", "dwa");