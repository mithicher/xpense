<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Expense;
use Faker\Generator as Faker;

$factory->define(Expense::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'category_id' => $faker->randomElement([1, 2, 3, 4, 5]),
        'expense_name' => $faker->realText(40, 1),
        'expense_details' => '',
        'expense_amount' => $faker->randomElement([100, 120, 250, 125, 200, 300, 400, 500, 1000, 2000, 1500, 2500]),
        'expense_date' => $faker->dateTimeBetween('-90 days', 'now')->format('Y-m-d')
    ];
});
