<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 26.04.2018
 * Time: 20:13
 */

namespace CommandsHandler;

use Commands\PingCommand;

class PingHandler
{


    /**
     * PingHandler constructor.
     */
    public function __construct()
    {
    }

    public function __invoke(PingCommand $command)
    {
        echo $command->getAction() . PHP_EOL;
    }
}