<?php

$factory->define(App\Variable::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "value" => $faker->name,
    ];
});
