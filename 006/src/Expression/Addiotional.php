<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 19.04.2018
 * Time: 23:40
 */

namespace Expression;

use IExpression;
use IStack;

class Addiotional implements IExpression
{
    public function calculate(IStack $stack) : IStack  {
        $stack->push($stack->pop() + $stack->pop());
        return $stack;
    }
}