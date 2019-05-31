<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 02.06.2018
 * Time: 00:34
 */

namespace Transaction;

class TransactionDTO
{
    public $id;
    public $amount;
    public $fromAccount;
    public $toAccount;
    public $status;

    /**
     * TransactionDTO constructor.
     * @param $id
     * @param $amount
     * @param $fromAccount
     * @param $toAccount
     * @param $status
     */
    public function __construct($id, $amount, $fromAccount, $toAccount, $status)
    {
        $this->id = $id;
        $this->amount = $amount;
        $this->fromAccount = $fromAccount;
        $this->toAccount = $toAccount;
        $this->status = $status;
    }


}