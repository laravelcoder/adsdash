<?php

$factory->define(App\Stylesheet::class, function (Faker\Generator $faker) {
    return [
        "order" => $faker->randomNumber(2),
        "link" => $faker->name,
    ];
});
