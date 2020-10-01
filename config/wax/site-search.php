<?php

return [
    'indexers' => [
        [
            'key' => 'pages',
            'class' => 'Wax\Pages\PagesIndexer',
            'title' => 'General',
        ],
        [
            'key' => 'listings',
            'class' => 'App\Indexers\ListingsIndexer',
            'title' => 'Listings',
        ],
    ],
];
