<?php

namespace Shop\Product;

use Money\Money;
use Shop\IProduct;

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
}