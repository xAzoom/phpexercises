<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 19.04.2018
 * Time: 20:18
 */

namespace Events;


use Money\Money;

class WalletWithdrew extends WalletEvent
{
    /** @var Money */
    private $moneyToWithdraw;

    /**
     * WalletWithdrew constructor.
     * @param Money $moneyToWithdraw
     */
    public function __construct(Money $moneyToWithdraw)
    {
        parent::__construct();
        $this->moneyToWithdraw = $moneyToWithdraw;
    }

    /**
     * @return Money
     */
    public function getMoneyToWithdraw(): Money
    {
        return $this->moneyToWithdraw;
    }
}