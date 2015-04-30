<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\Queue\InMemoryQueue;

class UpdateProcessorSpec extends ObjectBehavior
{
    public function let(
        InMemoryQueue $consumerQueue,
        InMemoryQueue $producerQueue
    ) {
        $this->beConstructedWith($consumerQueue, $producerQueue);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Training\UpdateProcessor');
    }

    public function it_should_process_events_and_send_for_another_process(
        InMemoryQueue $consumerQueue,
        InMemoryQueue $producerQueue
    )
    {
        // | 2015-01-01 | 5465413231 | 654654651 |
        $event_1 = array('date' => '2015-01-01', 'checksum' => '5465413231', 'mid' => '654654651');
        $event_2 = array('date' => '2015-01-02', 'checksum' => '5465413232', 'mid' => '654654652');
        $eventResult_1 = array('date' => '2015-01-01 00:00:00', 'checksum' => '5465413231', 'mid' => '654654651');
        $eventResult_2 = array('date' => '2015-01-02 00:00:00', 'checksum' => '5465413232', 'mid' => '654654652');

        $consumerQueue->get()->willReturn(array($event_1, $event_2));

        $producerQueue->add($eventResult_1)->shouldBeCalled();
        $producerQueue->add($eventResult_2)->shouldBeCalled();

        $this->process();
    }
}
