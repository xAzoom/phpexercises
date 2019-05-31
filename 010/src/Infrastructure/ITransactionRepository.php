<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 30.05.2018
 * Time: 21:20
 */

namespace Infrastructure;

use Ramsey\Uuid\Uuid;
use Transaction\Transaction;

interface ITransactionRepository
{
    public function get(Uuid $transactionId): ?Transaction;

    public function save(Transaction $transaction): void;
}