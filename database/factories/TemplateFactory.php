<?php

$factory->define(App\Template::class, function (Faker\Generator $faker) {
    return [
        "template_name" => $faker->name,
        "layout" => $faker->name,
        "description" => $faker->name,
    ];
});
