<?php

$factory->define(App\Template::class, function (Faker\Generator $faker) {
    return [
        "template_name" => $faker->name,
        "content" => $faker->name,
        "description" => $faker->name,
    ];
});
