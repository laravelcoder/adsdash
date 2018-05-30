<?php

$factory->define(App\Provider::class, function (Faker\Generator $faker) {
    return [
        "provider" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
    ];
});
