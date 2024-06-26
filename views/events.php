<?php

use Kirby\Events\Events;

return [
    'pattern' => 'events',
    'action'  => function () {
        return [
            'component' => 'k-events-view',
            'props' => [
                'events' => (Events::fetch_Events())
            ]
        ];
    }
];
?>