<?php

$factory->define(App\AdType::class, function (Faker\Generator $faker) {
    return [
        "codec" => $faker->name,
        "extention" => $faker->name,
        "ad_id" => factory('App\Ad')->create(),
    ];
});
