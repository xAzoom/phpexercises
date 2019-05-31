<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 02.06.2018
 * Time: 00:33
 */

namespace Infrastructure;


use PDO;
use Transaction\TransactionDTO;

class PDOTransactionFinder implements ITransactionFinder
{
    /** @var PDO */
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll(int $limit = 10, int $offset = 0)
    {
        $query = $this->db->prepare('SELECT `id`, `amount`, `fromAccount`, `toAccount`, `status`
        FROM `transaction` LIMIT :offset, :lim');
        $query->bindValue(':offset', $offset, PDO::PARAM_INT);
        $query->bindValue(':lim', $limit, PDO::PARAM_INT);
        $query->execute();

        $array = [];
        while ($details = $query->fetch()) {
            $array[] = new TransactionDTO($details['id'], $details['amount'], $details['fromAccount'],
                $details['toAccount'], $details['status']);
        }
        $query->closeCursor();
        return $array;
    }

}