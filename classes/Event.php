<?php

namespace Kirby\Events;

use Kirby\Data\Data;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Exception\NotFoundException;
use Kirby\Toolkit\V;
use Kirby\Http\Remote;
use Kirby\Events\DateDefinition;

class Event
{

    public int $id;
    public int $age_from = 0;
    public int $age_to = 0;
    public bool $booked_up = false;
    public array $categories = [];

    public array $date_definitions = [];
    public string $description = "";

    public string $link;
    public string|null $image;

    public string $name = "";
    public Organization $organisation;
    public string $status;
    public array $tags = [];
    public Place $place;



    public function __construct(
        int $id,
        string $name
    ) {
       $this->id = $id;
       $this->name = $name;
    }
    public static function fromJSON($json_data): Event
    {
        //var_dump($json_data);
        $event = new Event(id: $json_data->id, name: $json_data->name);
        $event->age_from = $json_data->age_from ?? 0;
        $event->age_to = $json_data->age_to ?? 0;
        $event->booked_up = $json_data->booked_up;
        foreach($json_data->categories as $category) {
            array_push($event->categories, new Category(id: $category->id, name: $category->name));
        }

        foreach($json_data->date_definitions as $date) {
            //$date = $json_data->date_definitions;

            $date_obj = new DateDefinition($date->id, $date->start);
            $date_obj->setEnd($date->end);
            $date_obj->allday = isset($date->allday) ? true : false;
            $date_obj->setRRule($date->recurrence_rule);
            array_push($event->date_definitions, $date_obj);
            
        }
        
        $event->description = $json_data->description;
        $event->link = $json_data->external_link != "" ? $json_data->external_link : API::$photo_base."/event/".$json_data->id;
        $event->image = $json_data->photo ? API::$photo_base.$json_data->photo->image_url : null;
        //$event->organization = Organization::from_json($json_data->organization);
            //$json_data->organisation,
        $event->status = $json_data->status ?? "";
        $event->tags =  explode(",",$json_data->tags);
        $event->place = Place::from_json($json_data->place);
        return $event;
    }


}

?>