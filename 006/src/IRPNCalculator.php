<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 20.04.2018
 * Time: 01:41
 */

interface IRPNCalculator
{
    public function calculate(string $expression) : float;
}