<?php

$factory->define(App\Channel::class, function (Faker\Generator $faker) {
    return [
        "channel" => $faker->randomNumber(2),
        "channel_name" => $faker->name,
    ];
});
