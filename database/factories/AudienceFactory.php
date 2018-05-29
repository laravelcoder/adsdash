<?php

$factory->define(App\Audience::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "value" => $faker->name,
    ];
});
