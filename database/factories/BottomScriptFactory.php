<?php

$factory->define(App\BottomScript::class, function (Faker\Generator $faker) {
    return [
        "script" => $faker->name,
        "name" => $faker->name,
        "jquery" => 0,
        "template_id" => factory('App\Template')->create(),
        "created_by_id" => factory('App\User')->create(),
        "created_by_team_id" => factory('App\Team')->create(),
    ];
});
