<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 12.04.2018
 * Time: 23:43
 */

interface IStack
{
    public function pop();
    public function push($val) : void;
    public function clear() : void;
}