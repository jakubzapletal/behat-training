<?php

namespace Training;

class Session
{
    /** @var Account */
    private $account;

    public function setAccount(Account $account)
    {
        $this->account = $account;
    }

    /**
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
