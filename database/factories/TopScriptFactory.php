<?php

$factory->define(App\TopScript::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "script" => $faker->name,
        "jquery" => 1,
        "template_id" => factory('App\Template')->create(),
    ];
});
