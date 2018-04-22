<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 05.04.2018
 * Time: 10:03
 */

use Money\Money;

interface Product
{
    public function getName(): string;
    public function getPrice(): Money;
}