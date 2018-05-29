<?php

$factory->define(App\Demographic::class, function (Faker\Generator $faker) {
    return [
        "demographic" => $faker->name,
        "value" => $faker->name,
        "audience_id" => factory('App\Audience')->create(),
    ];
});
