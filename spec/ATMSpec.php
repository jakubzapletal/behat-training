<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ATMSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\ATM');
    }

    public function it_should_have_cash()
    {
        $this->setCash(99);
        $this->getCash()->shouldBeLike(99);
    }

    public function it_should_drain_cash()
    {
        $this->setCash(99);
        $this->drain(30);
        $this->getCash()->shouldBeLike(69);
    }
}
