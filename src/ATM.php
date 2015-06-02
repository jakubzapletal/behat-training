<?php

namespace Training;

use Training\CashStorage\CashStorage;

class ATM
{
    /** @var CashStorage */
    private $cashStorage;

    public function __construct(CashStorage $cashStorage)
    {
        $this->cashStorage = $cashStorage;
    }

    /**
     * @return int
     */
    public function getCash()
    {
        return $this->cashStorage->getCash();
    }

    /**
     * @param int $amount
     */
    public function drain($amount)
    {
        $cash = $this->cashStorage->getCash();
        $cash -= $amount;
        $this->cashStorage->setCash($cash);
    }
}
