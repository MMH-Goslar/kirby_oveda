<?php

namespace Kirby\Events;
use DateTime;
use RRule\RRule;
use RRule\RSet;

class DateDefinition {
    public int $id;
    public DateTime $start;
    public DateTime|null $end;
    public bool $allDay = false;
    public string $reccurrence_rule;
    public array $excluded_dates = [];


    public function __construct(
        int $id,
        string $start
    ) {
        $this->id = $id;
        $this->start =new DateTime($start);

    }

    function setEnd(string|null $end ) {
        if($end) {
            $this->end = new DateTime($end);
        } else {
            $this->end = null;
        }
    }

    function setRRule(string $rrule) {
        if(isset($rrule) && $rrule !== "" ) {
            if( str_contains($rrule, "EXDATE")) {
                 $date_arr = explode("EXDATE:", $rrule);
                 $rrule = new RRule($date_arr[0]);
                 $this->reccurrence_rule = $rrule->humanReadable(['locale' => 'de']);

                 $date = new RSet($rrule);
                 foreach($date->getExDates() as $exdate) {
                    if($exdate > new DateTime('now')) {
                        $this->excluded_dates;
                    }
                 }
                 
                 

            } else {
                $date = new RRule($rrule);
                $this->reccurrence_rule = $date->humanReadable(['locale' => 'de']);
            }
           
            
        }

    }
    
}

?>