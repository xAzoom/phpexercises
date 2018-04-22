<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 05.04.2018
 * Time: 15:57
 */

namespace Cart\Promotion;


use Cart\Cart;
use Promotion;

class ProductName implements Promotion
{
    private $name;

    /**
     * ProductName constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }


    /**
     * @param Cart $cart
     * @return bool
     */
    public function isOk(Cart $cart): bool
    {
        foreach ($cart->getProductsArray() as $product) {
            if($product->getName() == $this->name) {
                return true;
            }
        }
        return false;
    }
}