<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\Queue\InMemoryQueue;
use Training\EventProcessor;

class UpdateProcessorSpec extends ObjectBehavior
{
    function let(
        InMemoryQueue $consumerQueue,
        InMemoryQueue $producerQueue,
        EventProcessor $eventProcessor
    ) {
        $this->beConstructedWith($consumerQueue, $producerQueue, $eventProcessor);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('Training\UpdateProcessor');
    }
    
    function it_should_process_events_and_send_for_another_process(
        InMemoryQueue $consumerQueue,
        InMemoryQueue $producerQueue,
        EventProcessor $eventProcessor
    ) {

        $events = array('event_1', 'event_2');

        $consumerQueue->get()->willReturn($events);
        $eventProcessor->process($events)->willReturn($events);
        
        $producerQueue->add($events[0])->shouldBeCalled();
        $producerQueue->add($events[1])->shouldBeCalled();
  
        $this->process();
    }
}
