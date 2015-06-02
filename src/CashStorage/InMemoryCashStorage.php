<?php

namespace Training\CashStorage;

class InMemoryCashStorage implements CashStorage
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
}
