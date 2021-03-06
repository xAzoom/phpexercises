<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 25.05.2018
 * Time: 00:58
 */

namespace borrow\Command;


use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadConstructable;
use Prooph\Common\Messaging\PayloadTrait;

class RegisterPenaltyPayment extends Command implements PayloadConstructable
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

    public function amount() : int
    {
        return $this->payload['amount'];
    }

    public function date() : int
    {
        return $this->payload['date'];
    }
}