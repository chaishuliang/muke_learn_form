<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $datetime = $faker->date()." ".$faker->time();
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'created_at' => $datetime,
        'updated_at' => $datetime,
    ];
});

$factory->define(App\Student::class, function (Faker\Generator $faker) {
    $datetime = $faker->date()." ".$faker->time();
    $sex = array(10,20,30);
    return [
        'name' => $faker->name,
        'age' => rand(1,100),
        'sex' => $sex[array_rand($sex,1)],//随机返回数组key，再取数组值
        'created_at' => $datetime,
        'updated_at' => $datetime,
    ];
});
