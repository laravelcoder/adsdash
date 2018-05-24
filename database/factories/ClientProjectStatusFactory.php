<?php

$factory->define(App\ClientProjectStatus::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
