<?php

namespace spec\Training;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Training\EventProcessor;

class EventProcessorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Training\EventProcessor');
    }
    
    function it_should_convert_date_string_into_a_datetime()
    {
        $events = array(
          array(
            'date' => '2015-01-02',
            'checksum' => '54886314',
            'mid' => '106651'),
          array(
            'date' => '2015-02-03',
            'checksum' => '54886315',
            'mid' => '106651'
          )
        );
        
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

        $this->process($events)->shouldBeLike($expectedEvents);
    }
}
