<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 26.04.2018
 * Time: 20:46
 */

namespace Routers;

use Command;
use Exceptions\NoRouteFoundException;
use Router;

class DirectRouter implements Router
{
    /** @var array */
    private $mapCommands;

    public function __construct(array $mapCommands)
    {
        $this->mapCommands = $mapCommands;
    }

    /**
     * @param Command $command
     * @return mixed
     * @throws NoRouteFoundException
     */
    public function route(Command $command) {
        if (array_key_exists(get_class($command), $this->mapCommands)) {
            return $this->mapCommands[get_class($command)];
        }
        throw new NoRouteFoundException("Command doesn't exist.");
    }
}