<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 16.03.2018
 * Time: 18:28
 */

use Money\Money;

interface IProduct
{
    public function getName(): string;

    public function getPrice(): Money;
}