<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 05.04.2018
 * Time: 11:58
 */

namespace Cart\Promotion;


use Cart\Cart;
use Promotion;

class CountProducts implements Promotion
{
    private $count;

    /**
     * CountProducts constructor.
     */
    public function __construct(int $count)
    {
        $this->count = $count;
    }

    /**
     * @param Cart $cart
     * @return bool
     */
    public function isOk(Cart $cart) : bool
    {
        if (count($cart) >= $this->count) {
            return true;
        }
        return false;
    }
}