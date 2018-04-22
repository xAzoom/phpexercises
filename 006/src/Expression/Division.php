<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 20.04.2018
 * Time: 00:28
 */

namespace Expression;


use IExpression;
use IStack;

class Division implements IExpression
{

    public function calculate(IStack $stack): IStack
    {
        $stack->push($stack->pop() / $stack->pop());
        return $stack;
    }
}