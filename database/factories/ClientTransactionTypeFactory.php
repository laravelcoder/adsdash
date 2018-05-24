<?php

$factory->define(App\ClientTransactionType::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
    ];
});
