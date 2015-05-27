<?php

namespace Training;

class EventProcessor
{
    public function process(array $events)
    {
        $result = array();
        foreach ($events as $event) {
            $result []= $this->processEvent($event);
        }
        return $result;
    }
    
    private function processEvent($event)
    {
        $event['date'] = date('Y-m-d H:i:s', strtotime($event['date']));
        return $event;
    }
}
