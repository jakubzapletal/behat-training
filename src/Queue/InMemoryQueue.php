<?php

namespace Training\Queue;

class InMemoryQueue
{

    private $events = array();
    
    public function add($event)
    {
        $this->events []= $event;
    }

    public function get()
    {
        return $this->events;
    }
}
