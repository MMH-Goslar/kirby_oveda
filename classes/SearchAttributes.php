<?php

namespace Kirby\Events;
use Kirby\Exception\InvalidArgumentException;


class SearchAttributes {

    public int $page;
    public int $number_of_results;
    public string $organizer_id;
    public string $event_place_id;
    private string $latitude;
    private string $longitude;
    private int $distance;
    private bool $coordinate_set = false;
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

        //Apply Place ID array if set
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
        if($this->coordinate_set) {
            $search_string .= "&coordinate=".$this->latitude.",".$this->longitude."&distance=".$this->distance;
        }

        if(isset($this->keyword) &&  $this->keyword !== "") {
            $search_string .= "&keyword=".$this->keyword;
        }

        $search_string .= "&sort=start";
        
        return $search_string;
    }

    public function set_coordinate(string $latitude, string $longitude, int $distance) {
        if (preg_match("/^[-+]?([1-8]?\d(\.\d+)?|90(\.0+)?)$/", $latitude)) {
            $this->latitude = $latitude;
        } else {
            throw new InvalidArgumentException("Longitude doesn't fit the neccesary format");
        }
        if (preg_match("/^[-+]?(180(\.0+)?|((1[0-7]\d)|([1-9]?\d))(\.\d+)?)$/", $longitude)) {
            $this->longitude = $longitude;
        } else {
            throw new InvalidArgumentException("Longitude doesn't fit the neccesary format");
        }
        if(preg_match("/^[0-9]{1,5}$/", $distance)) {
            $this->distance = $distance;
        } else {
            throw new InvalidArgumentException("Distance should be between 1 - 99999 m");
        }
        $this->coordinate_set = true;
    }
}