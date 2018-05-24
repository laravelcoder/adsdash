<?php

$factory->define(App\Station::class, function (Faker\Generator $faker) {
    return [
        "station_label" => $faker->name,
        "channel_number" => $faker->name,
        "provider_id" => factory('App\Provider')->create(),
    ];
});
