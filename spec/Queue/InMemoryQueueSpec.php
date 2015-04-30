<?php

namespace spec\Training\Queue;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InMemoryQueueSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Training\Queue\InMemoryQueue');
    }

    public function it_should_add_event()
    {
        $event = 'event';

        $this->add($event);

        $this->get()->shouldBeLike(array($event));
    }
}
