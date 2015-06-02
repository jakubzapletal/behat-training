<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ApplicationSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Training\Application');
    }

    public function it_should_have_container()
    {
        $this->getContainer()->shouldHaveType('Symfony\Component\DependencyInjection\ContainerBuilder');
    }
}
