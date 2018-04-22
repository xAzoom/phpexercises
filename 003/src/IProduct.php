<?php

namespace Shop;

use Money\Money;

interface IProduct
{
    public function getName(): string;
    
    public function getPrice(): Money;
}