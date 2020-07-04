<?php

use Faker\Generator as Faker;
use Wax\Core\Eloquent\Models\User\Group;

$factory->define(Group::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
