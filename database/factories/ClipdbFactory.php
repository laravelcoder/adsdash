<?php

$factory->define(App\Clipdb::class, function (Faker\Generator $faker) {
    return [
        "ad_id" => factory('App\Ad')->create(),
        "clip_label" => $faker->name,
        "link_to_clip" => $faker->name,
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
    ];
});
