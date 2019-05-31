<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 30.05.2018
 * Time: 21:14
 */

namespace Transaction;


use MyCLabs\Enum\Enum;

class Status extends Enum
{
    private const ACTIVE = "ACTIVE";
    private const BLOCKED = "BLOCKED";
    private const SUSPENDED = "SUSPENDED";
    private const CLOSED = "CLOSED";
}