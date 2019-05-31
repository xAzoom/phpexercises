<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 25.05.2018
 * Time: 00:44
 */

namespace borrow\CommandHandler;


use borrow\Process\Process;
use borrow\Process\ProcessManager;
use Storage\IDataBase;

class OverrunBookLimit
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

    public function __invoke(\borrow\Command\OverrunBookLimit $command)
    {
        $this->db->Insert("delayedReturnBook",
            $command->bookId(),
            [
                "accountId" => $command->accountID(),
                "date" => $command->date()
            ]);

        $this->processManager->run($command->bookId(), $command);
    }
}