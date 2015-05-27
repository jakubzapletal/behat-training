<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\Account;
use Training\ATM;

class WithdrawManagerSpec extends ObjectBehavior
{
    public function let(ATM $ATM)
    {
        $this->beConstructedWith($ATM);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\WithdrawManager');
    }

    public function it_should_withdraw_money_by_atm_from_account(
        Account $account,
        ATM $ATM
    ) {
        $amount = 99;

        $account->debit($amount)->shouldBeCalled();
        $ATM->drain($amount)->shouldBeCalled();

        $this->withdraw($account, $amount)->shouldBeLike($amount);
    }
}
