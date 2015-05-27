<?php

namespace Training;

class ATM
{
    /** @var int */
    private $cash;

    /**
     * @param int $cash
     */
    public function setCash($cash)
    {
        $this->cash = $cash;
    }

    /**
     * @return int
     */
    public function getCash()
    {
        return $this->cash;
    }

    /**
     * @param int $amount
     */
    public function drain($amount)
    {
        $this->cash -= $amount;
    }
}
