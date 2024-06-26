<?php

load([
  'Kirby\Events\Event' => __DIR__ . '/classes/Event.php',
  'Kirby\Events\Events' => __DIR__ . '/classes/Events.php',
  'Kirby\Events\API' => __DIR__ . '/classes/Api.php',
  'Kirby\Events\Category' => __DIR__ . '/classes/Category.php',
  'Kirby\Events\Location' => __DIR__ . '/classes/Location.php',
  'Kirby\Events\Organization' => __DIR__ . '/classes/Organization.php',
  'Kirby\Events\Organizations' => __DIR__ . '/classes/Organizations.php',
  'Kirby\Events\Place' => __DIR__ . '/classes/Place.php',
  'Kirby\Events\SearchAttributes' => __DIR__ . '/classes/SearchAttributes.php',
  'Kirby\Events\DateDefinition' => __DIR__ . '/classes/DateDefinition.php'
]);

Kirby::plugin('mmh-goslar/kirby-oveda', [

  'areas' => [
    'events' => [
        'label' => 'Oveda',
        'icon'  => 'oveda',
        'menu'  => true,

        'views' => [
          require __DIR__.'/views/events.php'
            
            
        ]
    ]
  ]
]);
?>
