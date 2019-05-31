<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 26.04.2018
 * Time: 20:11
 */

namespace Commands;

use Command;

class PingCommand extends Command
{
    private $action;

    public function __construct()
    {
        $this->action = "PING";
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }


}