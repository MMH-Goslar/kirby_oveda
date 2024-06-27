<?php

use Kirby\Events\Organizations;

return [
    'pattern' => 'organizers',
    'action'  => function () {
        return [
            'component' => 'k-events-view',
            'props' => [
                'events' => Organizations::fetch_orgas()
            ],
            'search' => 'organizations'
        ];
    }
];
?>