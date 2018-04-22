<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 05.04.2018
 * Time: 10:06
 */

namespace Product;

use Money\Money;
use Product;

class StandardProduct implements Product
{
    private $name;
    private $price;

    /**
     * StandardProduct constructor.
     * @param $name
     * @param $price
     */
    public function __construct(string $name, Money $price)
    {
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Money
     */
    public function getPrice(): Money
    {
        return $this->price;
    }

}