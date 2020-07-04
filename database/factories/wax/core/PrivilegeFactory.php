<?php

use Faker\Generator as Faker;
use Wax\Core\Eloquent\Models\User\Privilege;

$factory->define(Privilege::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email_verification' => false,
    ];
});
