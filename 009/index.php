<?php
if(PHP_SAPI != 'cli'){
    die('Aplikacja nie zostala uruchomiona na konsoli');
}

use borrow\Process\Process;
use borrow\Process\ProcessManager;
use Prooph\ServiceBus\CommandBus;
use Prooph\ServiceBus\EventBus;
use Prooph\ServiceBus\Plugin\Router\CommandRouter;
use Prooph\ServiceBus\Plugin\Router\EventRouter;
use Storage\FileDB;

require_once __DIR__ . '/vendor/autoload.php';

$db = new FileDB();

$eventBus = new EventBus();
$eventRouter = new EventRouter();

$eventRouter->route(borrow\Event\BookReturned::class)
    ->to(new borrow\EventHandler\BookRentalSettled());

$eventRouter->attachToMessageBus($eventBus);

$process = new Process(
    [\borrow\Command\BookBorrow::class,
    \borrow\Command\BookReturned::class],
    $eventBus,
    new \borrow\Event\BookReturned());

$processWithPenalty = new Process(
    [\borrow\Command\BookBorrow::class,
        \borrow\Command\OverrunBookLimit::class,
        \borrow\Command\CalculatePenalty::class,
        \borrow\Command\RegisterPenaltyPayment::class,
        \borrow\Command\BookReturned::class],
    $eventBus,
    new \borrow\Event\BookReturned());

$processManager = new ProcessManager("processList", $db, [$process, $processWithPenalty]);

$commandBus = new CommandBus();
$commandRouter = new CommandRouter();

$commandRouter->route(borrow\Command\BookBorrow::class)
    ->to(new borrow\CommandHandler\BookBorrow($db, $processManager));

$commandRouter->route(borrow\Command\OverrunBookLimit::class)
    ->to(new borrow\CommandHandler\OverrunBookLimit($db, $processManager));

$commandRouter->route(borrow\Command\CalculatePenalty::class)
    ->to(new borrow\CommandHandler\CalculatePenalty($db, $processManager));

$commandRouter->route(borrow\Command\RegisterPenaltyPayment::class)
    ->to(new borrow\CommandHandler\RegisterPenaltyPayment($db, $processManager));

$commandRouter->route(borrow\Command\BookReturned::class)
    ->to(new borrow\CommandHandler\BookReturned($db, $processManager));

$commandRouter->attachToMessageBus($commandBus);

switch ($argv[1]) {
    case "WypozyczonoKsiazke":
        $payload = ["bookId" => $argv[2],
                    "accountId" => $argv[3],
                    "dateBorrowed" => strtotime($argv[4]),
                    "dateOfReturn" => strtotime($argv[5])];
        $command = new borrow\Command\BookBorrow($payload);
        break;
    case "PrzekroczonoTerminOddaniaKsiazki":
        $payload = ["bookId" => $argv[2],
            "accountId" => $argv[3],
            "date" => strtotime($argv[4])];
        $command = new borrow\Command\OverrunBookLimit($payload);
        break;
    case "ObliczonoOplateKarna":
        $payload = ["bookId" => $argv[2],
            "accountId" => $argv[3],
            "amount" => (int) $argv[4],
            "date" => strtotime($argv[5])];
        $command = new borrow\Command\CalculatePenalty($payload);
        break;
    case "ZarejestrowanoWplateKary":
        $payload = ["bookId" => $argv[2],
            "accountId" => $argv[3],
            "amount" => (int) $argv[4],
            "date" => strtotime($argv[5])];
        $command = new borrow\Command\RegisterPenaltyPayment($payload);
        break;
    case "ZwroconoKsiazke":
        $payload = ["bookId" => $argv[2],
            "accountId" => $argv[3],
            "date" => strtotime($argv[4])];
        $command = new borrow\Command\BookReturned($payload);
        break;
}

if (isset($command)) {
    $commandBus->dispatch($command);
}