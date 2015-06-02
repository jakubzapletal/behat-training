<?php

namespace spec\Training\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\Session;
use Training\WithdrawManager;

class WithdrawCommandSpec extends ObjectBehavior
{
    public function let(WithdrawManager $withdrawManager, Session $session)
    {
        $this->beConstructedWith('name', $withdrawManager, $session);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\Command\WithdrawCommand');
    }

    public function it_should_extend_symfony_command()
    {
        $this->shouldHaveType('Symfony\Component\Console\Command\Command');
    }
}
