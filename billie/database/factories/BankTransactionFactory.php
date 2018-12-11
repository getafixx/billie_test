<?php

use Faker\Generator as Faker;

$factory->define(App\BankTransaction::class, function (Faker $faker) {
    return [
        'uuid'         => $faker->uuid(),
        'amount'       => $faker->randomFloat(2, 0),
        'booking_date' => $faker->dateTime(),
    ];
});
