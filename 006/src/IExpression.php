<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 20.04.2018
 * Time: 00:05
 */

interface IExpression
{
    public function calculate(IStack $stack) : IStack;
}