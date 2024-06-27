<?php 
use Kirby\Events\Organizations;
use Kirby\Events\SearchAttributes;

return [
    'label' => 'Veranstalter',
    'icon'  => 'cart',
    'query' => function (string $query) {
        $organizations = new Organizations([]);
        $search = new SearchAttributes();
        $search->keyword = $query;
        $organizations->search = $search;
        $organizations->fetch();
        $results  = [];
        foreach ($organizations->organizations as $organization) {
            $results[] = [
                'text' => $organization->name,
                'link' => '/products',
                'image' => [
                    'icon' => 'cart',
                    'back' => 'purple-400'
                ]
            ];
        }

        return $results;
    }
];
?>