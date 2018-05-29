<?php

$factory->define(App\Clipdb::class, function (Faker\Generator $faker) {
    return [
        "clip_label" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
    ];
});
