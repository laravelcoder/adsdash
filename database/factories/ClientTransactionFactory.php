<?php

$factory->define(App\ClientTransaction::class, function (Faker\Generator $faker) {
    return [
        "project_id" => factory('App\ClientProject')->create(),
        "transaction_type_id" => factory('App\ClientTransactionType')->create(),
        "income_source_id" => factory('App\ClientIncomeSource')->create(),
        "title" => $faker->name,
        "description" => $faker->name,
        "amount" => $faker->randomNumber(2),
        "currency_id" => factory('App\ClientCurrency')->create(),
        "transaction_date" => $faker->date("m/d/Y", $max = 'now'),
    ];
});
