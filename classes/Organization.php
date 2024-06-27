<?php

namespace Kirby\Events;


class Organization {
    public int $id;
    public string $name;
    public string $description;

    public string $email;

    public string $fax;

    public Location $location;



    public function __construct(int $id, string $name = "") {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Generates Organizer from JSON Object
     * @param array $json
     * 
     * @return Organization
     */
    public static function from_json($json): Organization {
        $organizer = new Organization($json->id, $json->name);
        $organizer->description = $json->description ?? "";
        $organizer->email = $json->email ?? "";
        $organizer->fax = $json->fax ?? "";
        if (isset($json->location)) {
            $organizer->location = Location::from_json($json->location);
        }
        return $organizer;
    }
}

?>