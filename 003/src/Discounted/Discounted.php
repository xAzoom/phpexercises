<?php

namespace Shop\Discounted;

use Money\Money;
use Shop\Product;
use Shop\Bundle;
use Shop\IProduct;

class Discounted implements IProduct {
	private $name;
	private $product;
	private $discount;

	public function __construct(string $name, IProduct $product, float $discount) {
		$this->name = $name;
		$this->product = $product;
		$this->discount = $discount;
	}

    public function getName(): string {
    	return $this->name;
    }
    
    public function getPrice(): Money {
    	return $this->product->getPrice()->multiply((100 - $this->discount) / 100);
    }
}