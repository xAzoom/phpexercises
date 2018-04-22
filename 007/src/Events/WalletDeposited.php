<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 19.04.2018
 * Time: 01:58
 */

namespace Events;


use Money\Money;

class WalletDeposited extends WalletEvent
{
    /** @var Money */
    private $moneyToDeposit;

    /**
     * WalletDeposited constructor.
     * @param Money $moneyToDeposit
     */
    public function __construct(Money $moneyToDeposit)
    {
        parent::__construct();
        $this->moneyToDeposit = $moneyToDeposit;
    }

    /**
     * @return Money
     */
    public function getMoneyToDeposit(): Money
    {
        return $this->moneyToDeposit;
    }
}