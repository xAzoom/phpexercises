<?php

namespace Shop\Bundle;

use Money\Money;
use Shop\Product\Product;
use Shop\IProduct;

class Bundle implements IProduct {
	private $name;
	private $price = NULL;
	private $arrayProduct = array();

	public function __construct(string $name, array $arrayProducts) {
		$this->name = $name;
		foreach ($arrayProducts as $value) {
			$this->addProduct($value);
		}

	}

    public function getName(): string {
    	return $this->name;
    }
    
    public function getPrice(): Money {
    	return $this->price;
    }

    public function getArray(): array {
    	return $this->arrayProduct;
    }

    private function addProduct(IProduct $product) {
    	if($this->addPrice($product->getPrice())) {
    		array_push($this->arrayProduct, $product);
    	}
    }

    private function addPrice(Money $price) : bool {
    	if (is_null($this->price)) {
    		$this->price = $price;
    		return true;
    	}
    	else if ($this->price->isSameCurrency($price)) {
    		$this->price = $this->price->add($price);
    		return true;
    	}
    	return false;
    }
}