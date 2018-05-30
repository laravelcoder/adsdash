<?php

$factory->define(App\Layout::class, function (Faker\Generator $faker) {
    return [
        "layout" => $faker->name,
        "path" => $faker->name,
        "address" => $faker->name,
        "template_id" => factory('App\Template')->create(),
    ];
});
