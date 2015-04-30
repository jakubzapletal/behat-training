<?php

namespace spec\Training\Console\Command;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\UpdateProcessor;

class UpdateCommandSpec extends ObjectBehavior
{
    public function let(UpdateProcessor $updateProcessor)
    {
        $name = 'test_name';

        $this->beConstructedWith($name, $updateProcessor);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\Console\Command\UpdateCommand');
    }

    public function it_should_extend_symfony_command()
    {
        $this->shouldHaveType('Symfony\Component\Console\Command\Command');
    }

    public function it_should_have_name()
    {
        $this->getName()->shouldBeLike('test_name');
    }
}
