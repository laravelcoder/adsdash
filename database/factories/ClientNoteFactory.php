<?php

$factory->define(App\ClientNote::class, function (Faker\Generator $faker) {
    return [
        "project_id" => factory('App\ClientProject')->create(),
        "text" => $faker->name,
    ];
});
