<?php

return [

    'feeds' => [
        [
            /*
             * Here you can specify which class and method will return
             * the items that should appear in the feed. For example:
             * '\App\Model@getAllFeedItems'
             */
            'items' => 'Wax\Blog\Repositories\BlogRepository@getAllFeedItems',

            /*
             * The feed will be available on this url.
             */
            'url' => 'blog/feed',

            'title' => 'Blog RSS',
        ],
    ],

];
