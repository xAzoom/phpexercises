<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 30.05.2018
 * Time: 21:50
 */

namespace Infrastructure;


use Money\Money;
use PDO;
use Ramsey\Uuid\Uuid;
use Transaction\Status;
use Transaction\Transaction;

class PDOTransactionRepository implements ITransactionRepository
{
    /** @var PDO */
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function get(Uuid $transactionId): ?Transaction
    {
        $query = $this->db->prepare('SELECT `amount`, `fromAccount`, `toAccount`, `status`
        FROM `transaction`
        WHERE `id` = :id');
        $query->bindValue(':id', $transactionId, PDO::PARAM_STR);
        $query->execute();

        if($details = $query->fetch()) {
            return new Transaction($transactionId, Money::PLN($details['amount']), $details['fromAccount'],
                $details['toAccount'], Status::__callStatic($details['status'], []));
        }
        return null;
    }

    public function save(Transaction $transaction): void
    {
        $save = $this->db->prepare('REPLACE INTO `transaction` 
        (`id`, `amount`, `fromAccount`, `toAccount`, `status`)
        VALUES(
          :id,
          :amount,
          :fromAccount,
          :toAccount,
          :status
        )');

        $save->bindValue(':id', $transaction->getUuid(), PDO::PARAM_STR);
        $save->bindValue(':amount', $transaction->getAmount()->getAmount(), PDO::PARAM_INT);
        $save->bindValue(':fromAccount', $transaction->getFromAccount(), PDO::PARAM_STR);
        $save->bindValue(':toAccount', $transaction->getToAccount(), PDO::PARAM_STR);
        $save->bindValue(':status', $transaction->getStatus(), PDO::PARAM_STR);

        $save->execute();
    }
}