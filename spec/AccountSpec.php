<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AccountSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\Account');
    }

    public function it_has_balance()
    {
        $this->setBalance(99);
        $this->getBalance()->shouldBeLike(99);
    }

    public function it_should_debit_balance()
    {
        $this->setBalance(99);
        $this->debit(20);
        $this->getBalance()->shouldBeLike(79);
    }
}
