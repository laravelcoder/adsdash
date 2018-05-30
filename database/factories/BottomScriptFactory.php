<?php

$factory->define(App\BottomScript::class, function (Faker\Generator $faker) {
    return [
        "script" => $faker->name,
        "name" => $faker->name,
        "jquery" => 0,
    ];
});
