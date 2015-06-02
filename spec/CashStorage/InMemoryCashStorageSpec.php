<?php

namespace spec\Training\CashStorage;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InMemoryCashStorageSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\CashStorage\InMemoryCashStorage');
    }

    public function it_should_implement_cash_storage()
    {
        $this->shouldImplement('Training\CashStorage\CashStorage');
    }

    public function it_should_have_cash()
    {
        $this->setCash(99);
        $this->getCash()->shouldBeLike(99);
    }
}
