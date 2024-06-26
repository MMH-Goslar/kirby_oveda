<?php

namespace Kirby\Events;


class SearchAttributes {

    public int $page;
    public int $number_of_results;
    public array $by_organizer_ids;
    public array $by_coordinate;
    public int $distance;
    public string $keyword = "";
    public string $date_from;
    public string $date_to;
    public string $status;

    public function __construct(
        
        int $page = 1,
        int $number_of_results = 30
    ) { 
        $this->page = $page;
        $this->number_of_results = $number_of_results;
    }

    public function toSearchString(): string {
        $search_string = "?page=".$this->page."&per_page=".$this->number_of_results;

        //Apply Organizer ID array if set
        if(isset($this->by_organizer_ids)) {
            $search_string .= "&[";
            foreach($this->by_organizer_ids as $organizer_id) {
                $search_string .= $organizer_id.",";
            }
            $search_string .= "]";
        }


        //Apply Search By Coordinate and Distance
        if(isset($this->by_coordinate) && isset($this->distance)) {
            $search_string .= "&coordinate=".$this->by_coordinate."&distance=".$this->distance;
        }

        $search_string .= "&keyword=".$this->keyword;
        return $search_string;
    }

}