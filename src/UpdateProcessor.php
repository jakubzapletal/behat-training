<?php

namespace Training;

use Training\Queue\InMemoryQueue;
use Training\EventProcessor;

class UpdateProcessor
{
    /** @var InMemoryQueue */
    private $consumerQueue;
    
    /** @var InMemoryQueue */
    private $producerQueue;
    
    /** var EventProcessor */
    private $eventProcessor;
    
    public function process()
    {
        $events = $this->consumerQueue->get();
        $events = $this->eventProcessor->process($events);
        foreach ($events as $event) {
            $this->producerQueue->add($event);
        }
    }

    public function __construct(
        InMemoryQueue $consumerQueue, 
        InMemoryQueue $producerQueue,
        EventProcessor $eventProcessor
    ) {
        $this->consumerQueue = $consumerQueue;
        $this->producerQueue = $producerQueue;
        $this->eventProcessor = $eventProcessor;
    }
}
