<?php

use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(50),
        'description' => $faker->realText(255),
        'priority' => rand(1,3),
        'category' => rand(1,3),
        'state' => rand(1,3),
        'user_id' => 1
    ];
});
