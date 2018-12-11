<?php

use Faker\Generator as Faker;

$factory->define(App\BankTransactionEntity::class, function (Faker $faker) {

    $reasonArray = App\BankTransactionEntity::getReasons();

    return [
        'amount'        => $faker->randomFloat(2, 0),
        'reason'        => $reasonArray[$faker->numberBetween(0, count($reasonArray)-1)],
        'bank_transaction_id'       => function () {
            return factory(App\BankTransaction::class)->create()->uuid;
        },
    ];

});
