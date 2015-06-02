<?php

namespace spec\Training\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WithdrawCommandSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\Command\WithdrawCommand');
    }

    public function it_should_extend_symfony_command()
    {
        $this->shouldHaveType('Symfony\Component\Console\Command\Command');
    }
}
