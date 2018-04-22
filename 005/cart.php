<?php

require_once __DIR__ . '/vendor/autoload.php';

use Cart\Cart;
use Cart\Promotion\CountAndTotal;
use Cart\Promotion\CountProducts;
use Cart\Promotion\ProductName;
use Cart\Promotion\TotalPrice;
use Product\StandardProduct;
use Money\Money;


$c = [new CountProducts(4),
    new TotalPrice(400),
    new ProductName("Słuchawki"),
    new CountAndTotal(2, 200)];

$c2 = [new TotalPrice(400)];

$product1 = new StandardProduct("Słuchawkii", Money::PLN(100));
$product2 = new StandardProduct("Monitor", Money::PLN(500));

$cart = new Cart();
$cart->addProduct($product1);


if ($cart->canAddGift($c)) {
    echo "TAK";
} else {
    echo "NIE";
}