<?php

$factory->define(App\ContactCompany::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "website" => $faker->name,
        "email" => $faker->name,
        "address" => $faker->name,
        "city" => $faker->name,
        "state" => $faker->name,
        "zipcode" => $faker->name,
    ];
});
