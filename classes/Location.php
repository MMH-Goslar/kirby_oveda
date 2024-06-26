<?php

namespace Kirby\Events;

class Location {
    public string $city;
    public string $country;
    public string $latitude;

    public string $longitude;

    public string $postal_code;

    public string $street;

    public function __construct(string $city, string $country, string $latitude, string $longitude, string $postal_code, string $street) { 
        $this->city = $city;
        $this->country = $country;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->postal_code = $postal_code;
        $this->street = $street;
    }

    public static function from_json(array $json): Location {
        $location = new Location(
            $json["city"],
            $json["country"],
            $json["latitude"],
            $json["longitude"],
            $json["postal_code"],
            $json["street"],
        );
        return $location;
    }
            


}

?>