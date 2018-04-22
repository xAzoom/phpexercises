<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 13.04.2018
 * Time: 00:23
 */

namespace RPNCalculator;

use Expression\Addiotional;
use Expression\Division;
use Expression\Multiply;
use Expression\Sin;
use Expression\Subtraction;
use IRPNCalculator;
use Stack\Stack;

class RPNCalculator implements IRPNCalculator
{
    private $functions = array();
    /**
     * RPNCalculator constructor.
     */
    public function __construct()
    {
        $this->functions["+"] = new Addiotional();
        $this->functions["-"] = new Subtraction();
        $this->functions["*"] = new Multiply();
        $this->functions["/"] = new Division();
        $this->functions["sin"] = new Sin();
    }

    public function calculate(string $expression) : float {
        $stack = new Stack();
        $symbols = explode(" ", $expression);

        foreach ($symbols as $symbol) {
            if(is_numeric($symbol)) {
                $stack->push((float) $symbol);
            } else {
                $stack = $this->functions[$symbol]->calculate($stack);
            }
        }

        return $stack->pop();
    }
}