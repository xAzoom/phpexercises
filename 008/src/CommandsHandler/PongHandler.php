<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 26.04.2018
 * Time: 20:14
 */

namespace CommandsHandler;

use Commands\PongCommand;

class PongHandler
{
    public function __invoke(PongCommand $command)
    {
        echo $command->getAction() . PHP_EOL;
    }
}