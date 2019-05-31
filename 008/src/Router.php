<?php

use Exceptions\NoRouteFoundException;

/**
 * Created by PhpStorm.
 * User: moren
 * Date: 26.04.2018
 * Time: 20:42
 */

interface Router
{
    /**
     * @param Command $command
     * @return mixed
     * @throws NoRouteFoundException
     */
    public function route(Command $command);
}