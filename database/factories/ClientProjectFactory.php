<?php

$factory->define(App\ClientProject::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "client_id" => factory('App\Client')->create(),
        "description" => $faker->name,
        "date" => $faker->date("m/d/Y", $max = 'now'),
        "budget" => $faker->name,
        "project_status_id" => factory('App\ClientProjectStatus')->create(),
    ];
});
