<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 20.04.2018
 * Time: 00:24
 */

namespace Expression;


use IExpression;
use IStack;

class Subtraction implements IExpression
{
    public function calculate(IStack $stack): IStack
    {
        $stack->push($stack->pop() - $stack->pop());
        return $stack;
    }

}