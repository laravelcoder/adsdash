<?php

$factory->define(App\Stylesheet::class, function (Faker\Generator $faker) {
    return [
        "link" => $faker->name,
        "template_id" => factory('App\Template')->create(),
    ];
});
