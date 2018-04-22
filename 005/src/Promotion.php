<?php

use Cart\Cart;

/**
 * Created by PhpStorm.
 * User: moren
 * Date: 05.04.2018
 * Time: 11:57
 */

interface Promotion
{
    /**
     * @param Cart $cart
     * @return bool
     */
    public function isOk(Cart $cart) : bool;
}