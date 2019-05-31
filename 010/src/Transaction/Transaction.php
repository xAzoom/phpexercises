<?php

namespace Transaction;

use Money\Money;
use Ramsey\Uuid\Uuid;
use Transaction\Status;

class Transaction
{
    /**
     * @var Uuid
     */
    private $Uuid;

    /**
     * @var Money
     */
    private $amount;

    /**
     * @var string
     */
    private $fromAccount;

    /**
     * @var string
     */
    private $toAccount;

    /**
     * @var Status
     *
     * Klasa Status rozszerza klasę Enum z biblioteki myclabs/php-enum i reprezentuje jeden ze statusów konta:
     * - ACTIVE
     * - BLOCKED
     * - SUSPENDED
     * - CLOSED
     */
    private $status;
    //Uuid $Uuid, Money $amount, string $fromAccount, string $toAccount, Status $status
    public function __construct(Uuid $Uuid, Money $amount, string $fromAccount, string $toAccount, Status $status)
    {
        $this->Uuid = $Uuid;
        $this->amount = $amount;
        $this->fromAccount = $fromAccount;
        $this->toAccount = $toAccount;
        $this->status = $status;
    }

    /**
     * @param Money $amount
     */
    public function setAmount(Money $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @param \Transaction\Status $status
     */
    public function setStatus(\Transaction\Status $status): void
    {
        $this->status = $status;
    }

    /**
     * @return Uuid
     */
    public function getUuid(): Uuid
    {
        return $this->Uuid;
    }

    /**
     * @return Money
     */
    public function getAmount(): Money
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getFromAccount(): string
    {
        return $this->fromAccount;
    }

    /**
     * @return string
     */
    public function getToAccount(): string
    {
        return $this->toAccount;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }


}