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
        InMemoryQueue $producerQueue
    ) {

        $event1 = array(
            'date' => '2015-01-02',
            'checksum' => '54886314',
            'mid' => '106651'
        );

        $event2 = array(
            'date' => '2015-02-03',
            'checksum' => '54886315',
            'mid' => '106651'
        );
        $events = array($event1, $event2);
        
        $consumerQueue->get()->willReturn($events);
        
        $expectedEvents = array(
          array(
            'date' => '2015-01-02 00:00:00',
            'checksum' => '54886314',
            'mid' => '106651'),
          array(
            'date' => '2015-02-03 00:00:00',
            'checksum' => '54886315',
            'mid' => '106651'
          )
        );
        
        $producerQueue->add($expectedEvents[0])->shouldBeCalled();
        $producerQueue->add($expectedEvents[1])->shouldBeCalled();
        
        $this->process();
    }
}
