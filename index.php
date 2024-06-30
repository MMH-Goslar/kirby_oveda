<?php
@include_once __DIR__ . '/vendor/autoload.php';
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
  'Kirby\Events\DateDefinition' => __DIR__ . '/classes/DateDefinition.php',
  'RRule\RRule' => __DIR__ . '',


]);
use Kirby\Events\Organizations;
use Kirby\Cms\Page;

Kirby::plugin('mmh-goslar/kirby-oveda', [
  'blueprints' => [
    'fields/orgaselect' => function($kirby) {
        return include __DIR__ . '/blueprints/fields/orgaselect.php';
    },
    'fields/placeselect' => function($kirby) {
      return include __DIR__ . '/blueprints/fields/placeselect.php';
    },
  ],
  'snippets'=> [
    'oveda' => __DIR__ . '/snippets/oveda.php',
    'oveda_element' => __DIR__ . '/snippets/oveda_element.php'
  ],
  'templates' => [
    'oveda.json' => __DIR__ . '/templates/oveda.json.php'
  ],
  'routes' => [
    [
      'pattern' => 'oveda.json',
      'action'  => function () {
        return new Page([
          'slug' => 'virtual-reality',
          'template' => 'oveda.json',
          'content' => [
            'title' => 'This is not a real page',
            'text'  => 'Believe it or not, this page is not in the file system'
          ]
        ]);
      }
    ]
  ],
/*  'fields' => [
    'organizerz' => [
      'props' => [
          'label' => function($label = "Test") {
              return $label;
          },
          'value' => function($value = "value") {
              return $value;
          }
        ],
      'computed' => [
          'controller' => function() {
              var_dump("loading");
              $organization_object = new Organizations();
  
              if($req_page = kirby()->request()->get('page')) {
                  $organization_object->search->page = $req_page;
                  
              };
              $organization_object->fetch();
              var_dump($organization_object);
              return [
                  'orgs' => $organization_object->organizations,
                  'has_next' => $organization_object->has_next,
                  'has_prev' => $organization_object->has_prev,
                  'total' => $organization_object->total,
                  'page' => $organization_object->page,
                  'pages' => $organization_object->pages 
              ];    
          }
        ]
      ]
    
  ],*/
  'areas' => [
    'organizers' => [
        'label' => 'Oveda',
        'icon'  => 'oveda',
        'menu'  => true,

        'views' => [
          require __DIR__.'/views/organizations.php'
            
            
        ],

        'searches' => [
          'organizations' => require __DIR__.'/searches/organizations.php'
        ]
    ]
  ],

  'sections' => [
    'oveda' => require __DIR__."/sections/oveda_section.php",
  ]
]);
?>
