<?php
use Faker\Generator as Faker;


$factory->define(App\APIModels\User::class, function (Faker $faker) {
 $password = $faker->shuffle(array("Sanda","xman","damm","Dff"));
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password[0],
        'remember_token' => str_random(10),
    ];
});