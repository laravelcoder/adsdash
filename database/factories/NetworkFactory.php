<?php

$factory->define(App\Network::class, function (Faker\Generator $faker) {
    return [
        "network" => $faker->name,
        "network_affiliate" => $faker->name,
    ];
});
