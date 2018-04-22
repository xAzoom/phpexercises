<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 19.04.2018
 * Time: 20:35
 */

namespace Events;


class WalletActivated extends WalletEvent
{
    /** @var string */
    private $reason;

    /**
     * WalletActivated constructor.
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