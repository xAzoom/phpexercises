<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 05.04.2018
 * Time: 16:09
 */

namespace Cart\Promotion;


use Cart\Cart;
use Promotion;

class CountAndTotal implements Promotion
{
    private $count;
    private $totalPrice;

    /**
     * CountAndTotal constructor.
     * @param $count
     * @param $totalPrice
     */
    public function __construct($count, $totalPrice)
    {
        $this->count = $count;
        $this->totalPrice = $totalPrice;
    }

    /**
     * @param Cart $cart
     * @return bool
     */
    public function isOk(Cart $cart): bool
    {
        $checkCount = new CountProducts($this->count);
        $checkTotalprice = new TotalPrice($this->totalPrice);

        if($checkCount->isOk($cart) && $checkTotalprice->isOk($cart)) {
            return true;
        }
        return false;
    }

}