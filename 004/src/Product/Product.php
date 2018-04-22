<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 16.03.2018
 * Time: 18:59
 */

namespace Product;

use Money\Money;
use IProduct;

class Product implements IProduct {
    private $name;
    private $price;

    public function __construct(string $name, Money $price) {
        $this->name = $name;
        $this->price = $price;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPrice(): Money {
        return $this->price;
    }

    public function getArrayToJSON() : array {
        return array(
            "name" => $this->name,
            "price" =>$this->price->getAmount(),
            "currency" => $this->price->getCurrency()
        );
    }
}