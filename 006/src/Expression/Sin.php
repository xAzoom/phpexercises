<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 20.04.2018
 * Time: 00:31
 */

namespace Expression;


use IExpression;
use IStack;

class Sin implements IExpression
{

    public function calculate(IStack $stack): IStack
    {
        $stack->push(sin($stack->pop()));
        return $stack;
    }
}