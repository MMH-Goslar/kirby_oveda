<?php

namespace Kirby\Events;

use Kirby\Events\Event;
use Kirby\Data\Data;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Exception\NotFoundException;
use Kirby\Toolkit\V;
use Kirby\Http\Remote;

class Events
{

    /**
     * Storing events from actual search
     * @var array<Event>
     */
    public array $events;
    /**
     * If actual search has a previous Page
     * @var int
     */
    public int $has_next = 0;
    /**
     * If actual search has a next Page
     * @var int
     */
    public int $has_prev = 0;
    public int $total = 0;
    public int $page = 0;
    public int $pages = 0;
    public int $next_num = 0;

    public SearchAttributes $search;



    public object $error;

    public function __construct(array $events = []) {
        $this->events = $events;
        $this->search = new SearchAttributes();
    }


    public static function fetch_Events(): Events {
        $events = new Events();
        $events->search = new SearchAttributes();
        $events->fetch();
        return $events;
    }
    /**
     * Creates a new event list from API with current SearchAttributes in $this->search
     * 
     * @return bool
     */
    public function fetch(): bool
    {
        $query_url = API::$base_url."events/search";
        $searchString = $this->search->toSearchString();

        $response = Remote::get($query_url.$searchString);
        if($response->code() !== 200) {
            
            //throw new NotFoundException("Server isnt reachable");
            return false;
        } else {
            $data = $response->json(false);
            $this->has_next = $data->has_next;
            $this->has_prev = $data->has_prev;
            $this->next_num = $data->next_num ?? 0;
            $this->page = $data->page;
            $this->pages = $data->pages;
            $this->total = $data->total;
            $this->events = static::conv_json_to_event($data->items);
            return true;

        }
    }

    /**
     * Fetches last Page of Results
     * @return bool
     */
    public function next(): bool {
        if($this->has_next != 0 && $this->page < $this->pages) {
            $this->search->page = $this->page + 1;
            $this->fetch();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Fetch last Page of Results
     * @return bool
     */
    public function prev(): bool {
        if($this->has_prev != 0 && $this->page > 1) {
            $this->search->page = $this->page - 1;
            $this->fetch();
            return true;
        } else {
            return false;
        }
    }

    
    /**
     * Convert JSON Data from API to typed Events
     * @param array<string> $items
     * 
     * @return array<Event>
     */
    public static function conv_json_to_event($items): array {
        $events = [];
        foreach($items as $json_event) {
            $event = Event::fromJson($json_event);
            $events[$event->id] = $event;
        }
        return $events;
    }

    /**
     * Finds an event by id and throws an exception
     * if the event cannot be found
     *
     * @param string $id
     * @return Event
     */
    public function by_id(string $id): Event 
    {
        $event = $this->events[$id];

        if (empty($event) === true) {
            throw new NotFoundException('The event could not be found');
        }

        return $event;
    }


    /**
     * Lists all available category types
     *
     * @return array<Category>
     */
    public static function types(): array
    {
        $query_url = API::$base_url."event-categories";
        $result = Remote::get($query_url);
        if($result->errorCode !== 200) {  
            throw new NotFoundException("".$result->errorCode);
         } else {
            $data = $result->json(false)["items"];
            $categories = [];
            foreach($data as $item) {
                $category = new Category($item->id, $item->name);
                array_push($categories,$category);
            }
            return $categories;

         }

    }

    public function getEventsByKeyword(string $keyword): bool {
        $this->search = new SearchAttributes();
        $this->search->keyword = $keyword;
        return $this->fetch();
    }

    public function getEventsByOrganizerIDs(array $organizer_ids): bool {
        $this->search = new SearchAttributes();
        $this->search->by_organizer_ids = $organizer_ids;
        return $this->fetch();
    }

    /**
     * Updates a product by id with the given input
     * It throws an exception in case of validation issues
     *
     * @param string $id
     * @param array $input
     * @return boolean
     */
    public static function update(string $id, array $input): bool
    {
        $product = [
            'id'          => $id,
            'title'       => $input['title'] ?? null,
            'type'        => $input['type'] ?? null,
            'description' => $input['description'] ?? null,
            'price'       => floatval($input['price'] ?? null)
        ];

        // require a title
        if (V::minlength($product['title'], 1) === false) {
            throw new InvalidArgumentException('The title must not be empty');
        }

        // make sure the title is not longer than expected
        if (V::maxlength($product['title'], 100) === false) {
            throw new InvalidArgumentException('The title must not be longer than 100 characters');
        }

        // validate the product category
        if (V::in($product['type'], static::types()) === false) {
            throw new InvalidArgumentException('Please select a valid product category');
        }

        // validate the price
        if (V::min($product['price'], 0.01) === false) {
            throw new InvalidArgumentException('The product must not be free');
        }

        // load all products
        $products = static::list();

        // set/overwrite the product data
        $products[$id] = $product;

        return Data::write(static::file(), $products);
    }

}