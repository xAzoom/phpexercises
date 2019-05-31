<?php

namespace borrow\Event;

use Prooph\Common\Messaging\DomainEvent;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

/**
 * Created by PhpStorm.
 * User: moren
 * Date: 24.05.2018
 * Time: 23:47
 */

class BookReturned extends DomainEvent implements PayloadConstructable
{
    use PayloadTrait;
}