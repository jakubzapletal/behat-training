<?php

namespace Training;

class WithdrawManager
{
    /** @var ATM */
    private $atm;

    public function __construct(ATM $ATM)
    {
        $this->atm = $ATM;
    }

    /**
     * @param Account $account
     * @param int $amount
     */
    public function withdraw(Account $account, $amount)
    {
        $account->debit($amount);
        $this->atm->drain($amount);

        return $amount;
    }
}
