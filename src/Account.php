<?php

namespace Training;

class Account
{
    /** @var int */
    private $balance;

    /**
     * @param int $balance
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    /**
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @param int $amount
     */
    public function debit($amount)
    {
        $this->balance -= $amount;
    }
}
