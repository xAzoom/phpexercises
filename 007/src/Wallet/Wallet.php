<?php
/**
 * Created by PhpStorm.
 * User: moren
 * Date: 18.04.2018
 * Time: 22:30
 */

namespace Wallet;

use Events\WalletActivated;
use Events\WalletCreated;
use Events\WalletDeactivated;
use Events\WalletDeposited;
use Events\WalletEvent;
use Events\WalletWithdrew;
use Money\Currency;
use Money\Money;
use Ramsey\Uuid\Uuid;

class Wallet
{
    /** @var string */
    private $id;
    /** @var Money $wallet */
    private $balance;
    /** @var bool */
    private $isActivate = false;

    private $events = [];

    public function __construct(string $currency = null, $activate = true)
    {
        if (isset($currency)) {
            $this->record(new WalletCreated(Uuid::uuid4()->toString(), new Currency($currency)));

            if ($activate) {
                $this->activate("Wallet Create");
            } else {
                $this->deactivate("Wallet Create");
            }
        }
    }

    private function record($event): void
    {
        $this->events[] = $event;

        $this->apply($event);
    }


    private function apply($event): void
    {
        switch (get_class($event)) {
            case WalletCreated::class:
                $this->createWallet($event);
                break;
            case WalletDeposited::class:
                $this->depositToWallet($event);
                break;
            case WalletWithdrew::class:
                $this->withdrawFromWallet($event);
                break;
            case WalletDeactivated::class:
                $this->deactivateWallet();
                break;
            case WalletActivated::class:
                $this->activateWallet();
                break;
        }
    }

    private function createWallet(WalletCreated $event): void
    {
        $this->id = $event->getWalletId();
        $this->balance = new Money(0, $event->getCurrency());
    }

    public function deposit(Money $moneyToDeposit): void
    {
        if ($moneyToDeposit->isNegative()) {
            throw new \RuntimeException("You can't deposit negative amount.");
        } elseif (!$moneyToDeposit->isSameCurrency($this->balance)) {
            throw new \RuntimeException("This wallet has a different currency.");
        } elseif (!$this->isActivate) {
            throw new \RuntimeException("You can't deposit money when wallet is deactivate.");
        } else {
            $this->record(new WalletDeposited($moneyToDeposit));
        }
    }

    private function depositToWallet(WalletDeposited $event): void
    {
        $this->balance = $this->balance->add($event->getMoneyToDeposit());
    }

    public function withdraw(Money $moneyToWithdraw): void
    {
        if ($this->balance->lessThan($moneyToWithdraw)) {
            throw new \RuntimeException("You don't have that much money in your wallet to withdraw it.");
        } elseif ($moneyToWithdraw->isNegative()) {
            throw new \RuntimeException("You can't withdraw negative amount.");
        } elseif (!$moneyToWithdraw->isSameCurrency($this->balance)) {
            throw new \RuntimeException("This wallet has a different currency.");
        } elseif (!$this->isActivate) {
            throw new \RuntimeException("You can't withdraw money when wallet is deactivate.");
        } else {
            $this->record(new WalletWithdrew($moneyToWithdraw));
        }
    }

    private function withdrawFromWallet(WalletWithdrew $event)
    {
        $this->balance = $this->balance->subtract($event->getMoneyToWithdraw());
    }

    public function deactivate(string $reason): void
    {
        if (!$this->isActivate) {
            throw new \RuntimeException("You can't deactivate wallet which is deactivate.");
        } else {
            $this->record(new WalletDeactivated($reason));
        }
    }

    private function deactivateWallet(): void
    {
        $this->isActivate = false;
    }

    public function activate(string $reason): void
    {
        if ($this->isActivate) {
            throw new \RuntimeException("You can't activate wallet which is activate.");
        }
        $this->record(new WalletActivated($reason));
    }

    private function activateWallet(): void
    {
        $this->isActivate = true;
    }

    /**
     * @return Money
     */
    public function getBalance(): Money
    {
        return $this->balance;
    }

    /**
     * @return array
     */
    public function getEvents(): array
    {
        return $this->events;
    }

    public static function fromEvents(array $events): Wallet
    {
        $newWallet = new Wallet();
        foreach ($events as $event) {
            $newWallet->apply($event);
        }

        return $newWallet;
    }
}