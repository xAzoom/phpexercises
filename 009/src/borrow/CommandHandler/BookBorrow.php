<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 24.05.2018
 * Time: 23:59
 */

namespace borrow\CommandHandler;

use borrow\Process\Process;
use borrow\Process\ProcessManager;
use Storage\IDataBase;

class BookBorrow
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

    public function __invoke(\borrow\Command\BookBorrow $command)
    {
        $this->db->Insert("bookListBorrowed",
            $command->bookId(),
            [
                "accountId" => $command->accountID(),
                "dateBorrowed" => $command->dateBorrowed(),
                "dateOfReturn" => $command->dateOfReturn()
            ]);

        $this->processManager->run($command->bookId(), $command);
    }
}