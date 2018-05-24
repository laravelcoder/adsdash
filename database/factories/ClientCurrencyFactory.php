<?php

$factory->define(App\ClientCurrency::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "code" => $faker->name,
        "main_currency" => 0,
    ];
});
