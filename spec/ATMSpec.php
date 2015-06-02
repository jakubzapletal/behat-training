<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\CashStorage\CashStorage;

class ATMSpec extends ObjectBehavior
{
    public function let(CashStorage $cashStorage)
    {
        $this->beConstructedWith($cashStorage);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\ATM');
    }

    public function it_should_have_cash(CashStorage $cashStorage)
    {
        $cashStorage->getCash()->willReturn(99);
        $this->getCash()->shouldBeLike(99);
    }

    public function it_should_drain_cash(CashStorage $cashStorage)
    {
        $cashStorage->getCash()->willReturn(99);
        $cashStorage->setCash(69)->shouldBeCalled();

        $this->drain(30);
    }
}
