<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Routine;
use Faker\Generator as Faker;
use App\User;

$factory->define(Routine::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return User::all()->random();
        },
        'name' => $faker->word,
        'description' => $faker->sentence(),

    ];
});
