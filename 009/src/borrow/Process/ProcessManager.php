<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 08.06.2018
 * Time: 02:19
 */

namespace borrow\Process;


use Prooph\Common\Messaging\Command;
use Storage\IDataBase;

class ProcessManager
{
    /** @var string */
    private $table;

    /** @var IDataBase */
    private $db;

    /** @var array */
    private $processes;

    /**
     * ProcessManager constructor.
     * @param string $table
     * @param IDataBase $db
     * @param array $processes
     */
    public function __construct(string $table, IDataBase $db, array $processes)
    {
        $this->table = $table;
        $this->db = $db;
        $this->processes = $processes;
    }

    public function run(string $id, Command $command)
    {
        $doneActions = $this->db->SelectById($this->table, $id);

        if (empty($doneActions)) {
            $this->db->Insert($this->table, $id, [get_class($command)]);
            return;
        }

        $doneActions[] = get_class($command);
        $this->db->Update($this->table, $id, $doneActions);

        foreach ($this->processes as $process) {
            if($process($id, $command, $doneActions)) {
                $this->ClearProcessList($id);
                break;
            }
        }
    }

    public function ClearProcessList(string $id)
    {
        $this->db->DeleteById($this->table, $id);
    }
}