<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 25.05.2018
 * Time: 01:08
 */

namespace borrow\CommandHandler;

use borrow\Process\Process;
use borrow\Process\ProcessManager;
use Storage\IDataBase;

class RegisterPenaltyPayment
{
    /** @var IDataBase */
    private $db;

    /** @var ProcessManager */
    private $processManager;

    public function __construct(IDataBase $db, ProcessManager $processManager = null)
    {
        $this->db = $db;
        $this->processManager = $processManager;
    }

    public function __invoke(\borrow\Command\RegisterPenaltyPayment $command)
    {
        $data = $this->db->SelectById("penalty", $command->bookId());

        if (!empty($data)) {
            if ($data["amount"] == $command->amount()) {
                $this->db->DeleteById("penalty", $command->bookId());
            } else {
                $this->db->Update("penalty", $command->bookId(), [
                    "accountId" => $command->accountID(),
                    "amount" => $command->amount(),
                    "date" => $command->date()
                ]);
            }
        }

        $this->processManager->run($command->bookId(), $command);
    }
}