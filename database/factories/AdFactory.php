<?php

$factory->define(App\Ad::class, function (Faker\Generator $faker) {
    return [
        "link" => $faker->name,
        "ad_label" => $faker->name,
        "ad_type" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
    ];
});
