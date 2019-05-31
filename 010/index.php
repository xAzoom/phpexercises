<?php

use Infrastructure\PDOTransactionFinder;
use Infrastructure\PDOTransactionRepository;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Transaction\Transaction;
use Transaction\Status;

require_once __DIR__ . '/vendor/autoload.php';

try {
    $db = new PDO('mysql:host=localhost;dbname=repository', 'repository', 'sIuVPsTmiILc5L7R');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    print "Błąd połączenia z bazą!: " . $e->getMessage() . "<br/>";
    die();
}

$dbRepository = new PDOTransactionRepository($db);
$dbFinder = new PDOTransactionFinder($db);

$id = Uuid::uuid4();

$transaction = new Transaction($id, Money::PLN(400), "Wojtek", "Maciek", Status::ACTIVE());

$dbRepository->save($transaction);

$newTransaction = $dbRepository->get($id);
$newTransaction->setAmount(Money::PLN(1000));
$newTransaction->setStatus(Status::SUSPENDED());

$dbRepository->save($newTransaction);

foreach ($dbFinder->findAll() as $value) {
    echo $value->id."\t".$value->amount."\t".$value->fromAccount."\t".$value->toAccount."\t".$value->status."\t".PHP_EOL;
}