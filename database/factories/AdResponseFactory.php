<?php

$factory->define(App\AdResponse::class, function (Faker\Generator $faker) {
    return [
        "station_id" => factory('App\Station')->create(),
        "time" => $faker->date("H:i:s", $max = 'now'),
        "impressions" => $faker->randomNumber(2),
        "non_impressions" => $faker->randomNumber(2),
        "cypi_id" => $faker->name,
    ];
});
