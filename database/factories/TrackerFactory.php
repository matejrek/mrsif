<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tracker;
use Faker\Generator as Faker;
use App\User;

$factory->define(Tracker::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return User::all()->random();
        },
        'unit_type' => 'kg',
        'name' => 'Weight tracker',
        'interval' => 1

    ];
});
