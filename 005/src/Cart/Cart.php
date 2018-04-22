<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 05.04.2018
 * Time: 10:15
 */

namespace Cart;

use Cart\Promotion\TotalPrice;
use Countable;
use Product;
use Money\Money;

class Cart implements Countable
{
    private $productsArray = array();
    private $gift = false;

    public function addProduct(Product $product) : void
    {
        array_push($this->productsArray, $product);
    }

    public function getProductsArray(): array
    {
        return $this->productsArray;
    }

    public function getTotalPrice(): Money
    {
        $totalPrice = Money::PLN(0);
        foreach ($this->productsArray as $product) {
            $totalPrice = $totalPrice->add($product->getPrice());
        }
        return $totalPrice;
    }

    public function count() : int
    {
        return sizeof($this->productsArray);
    }

    public function canAddGift( array $conditions): bool
    {
        foreach ($conditions as $condition) {
            if ($condition->isOk($this)) {
                return true;
            }
        }
        return false;
    }

    public function addGift(Product $gift) : bool {
        if (!$this->gift) {
            // tu pobieranie warunków z configu/bazy
            $conditions = [new TotalPrice(1000)];
            if ($this->canAddGift($conditions)) {
                $this->gift = true;
                $this->addProduct($gift);
            }
        }
    }
}