<?php

use Kirby\Events\Events;
use Kirby\Events\SearchAttributes;


    $latitude = get("latitude", null);
    $longitude = get("longitude", null);
    $distance = get("distance", null);
    $organizer_id = get('organizer', null);
    $page = get('page', '1');
    $results  = get('results', '6');
    $date_from = get('date_from',null);
    $date_to = get('date_to', null);

    $limit = 6;

    $events_manager = new Events([]);
    $search_attributes = new SearchAttributes($page, $limit);
        $organizer_id ? $search_attributes->organizer_id = $organizer_id : null;
        $date_from ? $search_attributes->date_from = $date_from : null;
        $date_to ? $search_attributes->date_to  = $date_to : null;

        if($latitude && $longitude && $distance) {
            $search_attributes.set_coordinate($latitude, $longitude, $distance);
        }

        $events_manager->search = $search_attributes;
        

        $kirby->response()->json();
        if($events_manager->fetch()) {

            $events = $events_manager->events;
            $more = $events_manager->has_next == 1 ? true : false;
            $html = "";
            $json = [];

            foreach($events as $event) {
    

              $html .= snippet('oveda_element', ["event" => $event], true);
              
              }
            $json['html'] = $html;
            $json['more'] = $more;
            $kirby->response()->code(200);
            echo json_encode($json);
        } else {
            $json['error'] = "Fetch wasn't successful";
            $kirby->response()->code(400);
            echo json_encode($json);
        }
    




      
    

?>