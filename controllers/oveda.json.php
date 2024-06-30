<?

use Kirby\Events\Events;
use Kirby\Events\SearchAttributes;
return function ($page) {

    $oveda_search = $page->oveda();
    
    $limit = 6;

    $events_manager = new Events([]);
    $search_attributes = new SearchAttributes(1, $limit);
    if ($oveda_search->exists() && $search = $oveda_search->toObject()) {

        if ($oveda_search->organziers()->isNotEmpty()) {
            $search_attributes->organizer_id = $search->organizer();
        }
    
        if ($oveda_search->start()->isNotEmpty()) {
            $search_attributes->date_from = $search->start()->format("Y-m-d")->toString();
        } else {
            $search_attributes->date_from = (new DateTime("now"))->format("Y-m-d");
        }
    
        $events_manager->search = $search_attributes;

        if($events_manager->fetch()) {
            return [
                'event' => $events_manager->events,
                'more'     => $events_manager->has_next == 1 ? true : false,
                'html'     => '',
                'json'     => [],
            ];
        }
    }
};
?>