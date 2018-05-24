<?php

$factory->define(App\Profile::class, function (Faker\Generator $faker) {
    return [
        "created_by_id" => factory('App\User')->create(),
    ];
});
