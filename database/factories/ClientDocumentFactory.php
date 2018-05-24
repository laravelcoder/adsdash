<?php

$factory->define(App\ClientDocument::class, function (Faker\Generator $faker) {
    return [
        "project_id" => factory('App\ClientProject')->create(),
        "title" => $faker->name,
        "description" => $faker->name,
    ];
});
