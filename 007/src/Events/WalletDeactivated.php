<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 19.04.2018
 * Time: 20:32
 */

namespace Events;


class WalletDeactivated extends WalletEvent
{
    /** @var string */
    private $reason;

    /**
     * WalletDeactivated constructor.
     * @param string $reason
     */
    public function __construct(string $reason)
    {
        parent::__construct();
        $this->reason = $reason;
    }

    /**
     * @return string
     */
    public function getReason(): string
    {
        return $this->reason;
    }
}