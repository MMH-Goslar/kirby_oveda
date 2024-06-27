<?php 
use Kirby\Events\Organizations;

[
    'props' => [
        'label' => function($label = "Test") {
            return $label;
        },
        'value' => function($value = "value") {
            return $value;
        },
        'controller' => function() {
            var_dump("loading");
            $organization_object = new Organizations();

            if($req_page = kirby()->request()->get('page')) {
                $organization_object->search->page = $req_page;
                
            };
            $organization_object->fetch();
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
];
?>