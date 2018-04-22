<?php

require 'vendor/autoload.php';

use Money\Money;
use Shop\Product\Product;
use Shop\Bundle\Bundle;
use Shop\Discounted\Discounted;

$sluchawki = new Product("Słuchawki Sonny", Money::PLN(1000));
$mikrofon = new Product("Mikrofon Blue Yeti", Money::PLN(800));
$klawiatura = new Product("Razer 2000", Money::PLN(2000));
$monitor = new Product("Monitor Sonny", Money::PLN(1500));
$mikrofonPoPrzecenie = new Discounted("Przeceniony Mikrofon BY", $mikrofon, 10);
$podkladka = new Product("Podkładka PRO", Money::PLN(200));
$podkladkaPoPrzecenie = new Discounted("Przeceniona Podkładka", $mikrofon, 10);
$zestaw = new Bundle("Zestaw Gracza", [$sluchawki, $mikrofonPoPrzecenie, $klawiatura]);

$totalPrice = Money::PLN(0);

$products = [
    $zestaw,
    $monitor,
    $podkladkaPoPrzecenie
];

foreach ($products as $product) {
    echo $product->getName() . PHP_EOL;
    
    $totalPrice = $totalPrice->add($product->getPrice());
}

echo 'TOTAL PRICE: '.$totalPrice->getAmount();