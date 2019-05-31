<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 27.04.2018
 * Time: 09:23
 */

namespace CommandsHandler;


use Command;

class EchoHandler
{
    private $message;

    /**
     * EchoHandler constructor.
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    public function __invoke(Command $command)
    {
        echo $this->message . PHP_EOL;
    }


}