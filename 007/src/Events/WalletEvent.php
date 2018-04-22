<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 19.04.2018
 * Time: 01:35
 */

namespace Events;


abstract class WalletEvent
{
    protected $time;

    /**
     * WalletEvent constructor.
     * @param $time
     */
    public function __construct()
    {
        $this->time = time();
    }

    /**
     * @return int
     */
    public function getTime(): int
    {
        return $this->time;
    }
}