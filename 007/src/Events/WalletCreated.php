<?php

namespace Events;

use Events\WalletEvent;
use Money\Currency;
use Ramsey\Uuid\Uuid;

/**
 * Created by PhpStorm.
 * User: moren
 * Date: 19.04.2018
 * Time: 01:26
 */

class WalletCreated extends WalletEvent
{
    /** @var string */
    private $walletId;
    /** @var Currency */
    private $currency;

    /**
     * WalletCreated constructor.
     * @param string $walletId
     * @param Currency $currency
     */
    public function __construct(string $walletId, Currency $currency)
    {
        parent::__construct();
        $this->walletId = $walletId;
        $this->currency = $currency;
    }

    /**
     * @return string
     */
    public function getWalletId(): string
    {
        return $this->walletId;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }


}