<?php

$factory->define(App\Ad::class, function (Faker\Generator $faker) {
    return [
        "ad_label" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
        "ad_description" => $faker->name,
        "total_impressions" => $faker->randomNumber(2),
        "total_networks" => $faker->randomNumber(2),
        "total_channels" => $faker->randomNumber(2),
    ];
});
