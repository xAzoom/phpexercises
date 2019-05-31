<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 26.04.2018
 * Time: 20:44
 */

namespace CommandBus;

use Command;
use Exception;
use Exceptions\NoRouteFoundException;
use Router;
use RuntimeException;

class CommandBus
{
    /** @var Router */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @throws NoRouteFoundException
     */
    public function dispatch(Command $command): void
    {
        try {
            /*
            $handlerClass = $this->router->route($command);
            $handler = new $handlerClass;
            $handler($command);
            */
            $handler = $this->router->route($command)();

            $handler($command);
        } catch (NoRouteFoundException $e) {
            throw new NoRouteFoundException($e->getMessage());
        }
    }
}