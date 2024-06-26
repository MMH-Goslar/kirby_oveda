<?php

namespace Kirby\Events;
use DateTime;

class DateDefinition {
    public int $id;
    public DateTime $start;
    public DateTime $end;
    public bool $allDay = false;
    public string $reccurrence_rule;


    public function __construct(
        int $id,
        string $start,
        string $end,
        bool $allDay,
        string $reccurrence_rule = ""
    ) {
        $this->id = $id;
        $this->from =new DateTime($start);
        $this->to = new DateTime($end);
        #TODO: Handle conversion
        $this->reccurrence_rule = $reccurrence_rule;
        $this->allDay = $allDay;
    }
    
}

?>