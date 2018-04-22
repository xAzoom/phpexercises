<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 05.04.2018
 * Time: 15:49
 */

namespace Cart\Promotion;


use Cart\Cart;
use Money\Money;
use Promotion;

class TotalPrice implements Promotion
{
    /**
     * @var Money
     */
    private $totalPrice;

    /**
     * TotalPrice constructor.
     * @param $totalPrice
     */
    public function __construct($totalPrice)
    {
        $this->totalPrice = $totalPrice;
    }

    /**
     * @param Cart $cart
     * @return bool
     */
    public function isOk(Cart $cart): bool
    {
        if ($cart->getTotalPrice()->getAmount() >= $this->totalPrice) {
            return true;
        }
        return false;
    }
}