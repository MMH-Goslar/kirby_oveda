<?php

namespace Kirby\Events;


class SearchAttributes {

    public int $page;
    public int $number_of_results;
    public string $organizer_id;
    public string $event_place_id;
    public string $by_coordinate;
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
        if(isset($this->organizer_id) && $this->organizer_id !== "" ) {
            $search_string .= "&organization_id=".$this->organizer_id;
        }

        //Apply Organizer ID array if set
        if(isset($this->event_place_id) && $this->event_place_id !== "" ) {
            $search_string .= "&event_place_id=".$this->event_place_id;
        }

        //Apply Start and End for Query
        if(isset($this->date_from) &&  $this->date_from !== "") {
            $search_string .= "&date_from=".$this->date_from;
        }

        if(isset($this->date_to) &&  $this->date_to !== "") {
            $search_string .= "&date_to=".$this->date_to;
        }



        //Apply Search By Coordinate and Distance
        if(isset($this->by_coordinate) && isset($this->distance)) {
            $search_string .= "&coordinate=".$this->by_coordinate."&distance=".$this->distance;
        }
        if(isset($this->keyword) &&  $this->keyword !== "") {
            $search_string .= "&keyword=".$this->keyword;
        }
        
        return $search_string;
    }

}