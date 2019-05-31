<?php

namespace borrow\Command;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

/**
 * Created by PhpStorm.
 * User: moren
 * Date: 24.05.2018
 * Time: 23:53
 */

class BookBorrow extends Command implements PayloadConstructable
{
    use PayloadTrait;

    public function bookId() : string
    {
        return $this->payload['bookId'];
    }

    public function accountID() : string
    {
        return $this->payload['accountId'];
    }

    public function dateBorrowed() : int
    {
        return $this->payload['dateBorrowed'];
    }

    public function dateOfReturn() : int
    {
        return $this->payload['dateOfReturn'];
    }
}