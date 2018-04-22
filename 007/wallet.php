<?php

use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;
use Wallet\Wallet;

require_once __DIR__ . '/vendor/autoload.php';

date_default_timezone_set('Europe/Warsaw');

if (PHP_SAPI != 'cli') {
    die('Aplikacja nie zostala uruchomiona na konsoli');
}

$currency = $argv[1];
$n = (int)$argv[2];
$withdraw = 2 + $n + 1;

$obj = new Wallet($currency);

for ($i = 1; $i <= $n; $i++) {
    $obj->deposit(new Money((int)$argv[2 + $i], new Currency($currency)));
}
$obj->withdraw(new Money((int) $argv[2 + $n + 1], new Currency($currency)));

echo $obj->getBalance()->getAmount() . " PLN";