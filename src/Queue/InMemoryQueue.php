<?php

namespace Training\Queue;

class InMemoryQueue
{
    private $events = array();

    public function add($argument1)
    {
        $this->events[] = $argument1;
    }

    public function get()
    {
        return $this->events;
    }
}
