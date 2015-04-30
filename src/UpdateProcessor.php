<?php

namespace Training;

use Training\Queue\InMemoryQueue;

class UpdateProcessor
{

    private $consumerQueue;

    private $producerQueue;

    public function process()
    {
        $events = $this->consumerQueue->get();

        foreach ($events as $event) {
            $event['date'] = date('Y-m-d H:i:s', strtotime($event['date']));

            $this->producerQueue->add($event);
        }
    }

    public function __construct(InMemoryQueue $consumerQueue, InMemoryQueue $producerQueue)
    {
        $this->consumerQueue = $consumerQueue;
        $this->producerQueue = $producerQueue;
    }
}
