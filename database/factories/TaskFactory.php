<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;
use App\User;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return User::all()->random();
        },
        'name' => $faker->name(),
        'description' => $faker->sentence(),
        'dateTime' => $faker->dateTimeBetween('next Monday', 'next Monday +17 days'),
        'completed' => $faker->numberBetween(0,1)
    ];
});
