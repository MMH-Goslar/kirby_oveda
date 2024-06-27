<?php

use Kirby\Events\Organization;
use Kirby\Events\Organizations;

return [
    'pattern' => 'organizers',
    'action'  => function () {
        return [
            'component' => 'k-events-view',
            'props' => [
                'controller' => function() {
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
                
            ],
            'search' => 'organizations'
        ];
    }
];
?>