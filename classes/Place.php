<?php

namespace Kirby\Events;

/**
 * Where an Event takes place
 */
class Place {

    /**
     * @var int
     */
    public int $id;
    /**
     * @var string
     */
    public string $name;
    /**
     * @var string
     */
    public string | null $description;
    /**
     * @var string
     */

    public string | null $url;

    /**
     * @var string
     */
    public string | null $photo;

    /**
     * @var Location
     */
    public Location | null $location;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Generates Place from JSON
     * @param array $json
     * 
     * @return Place
     */
    public static function from_json(object $json): Place {
        $place = new self($json->id, $json->name);
        $place->description = $json->description;
        $place->url = $json->url;
        $place->photo = $json->photo != null ? $json->photo->image_url : null;
        $place->location = $json->location != "" ? Location::from_json($json->location) : null;
        return $place;
    }

    
            


}

?>