<?php

namespace Kirby\Events;

use Kirby\Events\Event;
use Kirby\Data\Data;
use Kirby\Events\Place;
use Kirby\Events\SearchAttributes;
use Kirby\Exception\InvalidArgumentException;
use Kirby\Exception\NotFoundException;
use Kirby\Toolkit\V;
use Kirby\Http\Remote;

class Places
{

    /**
     * Storing events from actual search
     * @var array<Place>
     */
    public array $places;
    /**
     * If actual search has a next Page
     * @var int
     */
    public int $has_next = 0;
    /**
     * If actual search has a previous Page
     * @var int
     */
    public int $has_prev = 0;
    public int $total = 0;
    public int $page = 1;
    public int $pages = 0;
    public int $next_num = 0;

    public SearchAttributes $search;



    public object $error;

    public function __construct(array $places = []) {
        $this->places = $places;
        $this->search = new SearchAttributes();
    }

    public static function fetch_places(): Places {
        $places = new Places([]);
        $fetching = $places->fetch();
        while($places->has_next == 1 && $fetching) {
            $fetching = false;
            $places->search->page += 1;
            $fetching = $places->fetch();
        }
        return $places;
    }

    /**
     * Creates a new event list from API with current SearchAttributes in $this->search
     * 
     * @return bool
     */
    public function fetch(): bool
    {
        $query_url = API::$base_url."places";
        $searchString = $this->search->toSearchString();
        $response = Remote::get($query_url.$searchString);
        if($response->code() !== 200) {
            throw new NotFoundException("Server isnt reachable");
        } else {
            $data = $response->json(false);
            $this->has_next = $data->has_next ?? 0;
            $this->has_prev = $data->has_prev ?? 0;
            $this->next_num = $data->next_num ?? 0;
            $this->page = $data->page;
            $this->pages = $data->pages;
            $this->total = $data->total;
            array_push($this->places, ...static::convert_json_to_places($data->items));
            //var_dump($this->organizations);
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


    public static function convert_json_to_places($data): array {
        $places = [];
        foreach($data as $item) {
            $place = place::from_json($item);
            array_push($places, $place);
        }
        return $places;
    }
   

    /**
     * Finds an event by id and throws an exception
     * if the event cannot be found
     *
     * @param string $id
     * @return Event
     */
    public function by_id(string $id): place 
    {
        $event = $this->places[$id];

        if (empty($event) === true) {
            throw new NotFoundException('The event could not be found');
        }

        return $event;
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