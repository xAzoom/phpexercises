<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 25.05.2018
 * Time: 01:47
 */

namespace borrow\CommandHandler;


use borrow\Process\ProcessManager;
use Storage\IDataBase;

class BookReturned
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

    public function __invoke(\borrow\Command\BookReturned $command)
    {
        $this->db->DeleteById('bookListBorrowed', $command->bookId());
        $this->db->DeleteById('delayedReturnBook', $command->bookId());

        $this->processManager->run($command->bookId(), $command);
        $this->processManager->ClearProcessList($command->bookId());
    }
}