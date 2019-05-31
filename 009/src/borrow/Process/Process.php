<?php

namespace borrow\Process;

use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\DomainEvent;
use Prooph\ServiceBus\EventBus;
use Storage\IDataBase;

/**
 * Created by PhpStorm.
 * User: moren
 * Date: 08.06.2018
 * Time: 00:46
 */
class Process
{
    /** @var array */
    private $expected;

    /** @var EventBus */
    private $eventBus;

    /** @var DomainEvent */
    private $event;

    /**
     * Process constructor.
     * @param array $expected
     * @param EventBus $eventBus
     * @param DomainEvent $event
     */
    public function __construct(array $expected, EventBus $eventBus, DomainEvent $event)
    {
        $this->expected = $expected;
        $this->eventBus = $eventBus;
        $this->event = $event;
    }

    public function __invoke(string $id, Command $command, array $doneActions): bool
    {
        if($this->expected === $doneActions) {
            $this->eventBus->dispatch($this->event);
            return true;
        }
        return false;
    }
}