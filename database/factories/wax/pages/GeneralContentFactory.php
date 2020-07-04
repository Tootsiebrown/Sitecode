<?php

use Wax\Pages\Models\Content\GeneralContent;
use Faker\Generator as Faker;
use App\Wax\Data;
use Wax\Html;

$factory->define(GeneralContent::class, function (Faker $faker) {
    $title = $faker->text(40);
    return [
        'title' => $title,
        'url_slug' => Data::titleToUrl($title),
        'tab_title' => config('app.name') . " | $title",
        'content' => Html::textToHtml($faker->paragraph(4) . "\n\n" . $faker->paragraph(5) . "\n\n" . $faker->paragraph(5) . "\n\n" . $faker->paragraph(5)),
        'parent_id' => 0,
        'url_lock' => 0,
    ];
});
