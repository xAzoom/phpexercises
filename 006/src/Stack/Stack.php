<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 12.04.2018
 * Time: 23:47
 */

namespace Stack;
use IStack;

class Stack implements IStack
{
    private $list = array();

    public function pop(): float
    {
        if (count($this->list) == 0) {
            throw new \RuntimeException("Empty Stack");
        }
        return array_pop($this->list);
    }

    public function push($val): void
    {
        $this->list[] = $val;
    }

    public function clear(): void
    {
        $this->list = array();
    }
}