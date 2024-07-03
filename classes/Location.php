<?php

namespace Kirby\Events;

class Location {
    public string | null $city;
    public string | null $country;
    public string | null $latitude;

    public string | null $longitude;

    public string | null $postalCode;

    public string | null $street;

    public function __construct(string | null $city, string | null $country, string | null $latitude, string | null $longitude, string | null $postalCode, string | null $street) { 
        $this->city = $city;
        $this->country = $country;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->postalCode = $postalCode;
        $this->street = $street;
    }

    public static function from_json(object $json): Location {
        $location = new Location(
            $json->city,
            $json->country,
            $json->latitude,
            $json->longitude,
            $json->postalCode,
            $json->street,
        );
        return $location;
    }
            


}

?>