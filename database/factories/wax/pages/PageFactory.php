<?php

use Carbon\Carbon;
use Faker\Generator as Faker;
use Wax\Pages\Models\Page;
use Wax\Pages\Models\Content\GeneralContent;

$factory->define(Page::class, function (Faker $faker) {
    return [];
});

$factory->state(Page::class, 'gencon', function (Faker $faker) {
    $gencon = factory(GeneralContent::class)->create();
    return [
        'content_type' => get_class($gencon),
        'content_id' => $gencon->id,
        'breadcrumb' => $gencon->title,
        'url' => '/' . $gencon->url_slug,
        'title' => $gencon->title,
        'search_index' => json_encode(array_diff_key($gencon->toArray(), ['search_index' => '', 'page' => ''])),
        'url_slug' => $gencon->url_slug,
        'parent_id' => 0,
        'url_lock' => 0,
        'exclude_from_menu' => 0,
        'new_window' => 0,
    ];
});

$factory->state(Page::class, 'published-yesterday', [
    'published_at' => Carbon::parse('yesterday'),
]);
