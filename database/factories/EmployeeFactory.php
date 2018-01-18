<?php
use Faker\Generator as Faker;


$factory->define(App\APIModels\Employee::class, function (Faker $faker) {
 $Category = $faker->shuffle(array("part","full"));
 $password = $faker->shuffle(array("Sanda","xman","damm","Dff"));
    return [
        'first_name' => $faker->name,
        'middle_name' => $faker->name,
        'last_name' => $faker->name,
        'dob' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'user_id' => $faker->name,
        'password' => $password[0],
        'email' => $faker->unique()->safeEmail,
        'working_hours' => $faker->time($format = 'H:i:s', $max = 'now'),
        'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'type' => $Category[0],
        'desc' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true),
        'dep_id' => $faker->numberBetween($min = 1, $max = 9)
        
        
    ];
});