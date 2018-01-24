<?php
use Faker\Generator as Faker;


$factory->define(App\APIModels\Employee::class, function (Faker $faker) {
 $Category = $faker->shuffle(array("part","full"));
 $password = $faker->shuffle(array("Sanda","xman","damm","Dff"));
    return [
        'EmployeeID' => $faker->unique()->numberBetween($min = 1, $max = 9000),
        'FirstName' => $faker->name,
        'MiddleName' => $faker->name,
        'LastName' => $faker->name,
        'DOB' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'Username' => $faker->name,
        'Password' => $password[0],
        'EmailAddress' => $faker->unique()->safeEmail,
        'WorkingHours' => $faker->numberBetween($min = 1, $max = 90),
        'StartDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'Category' => $Category[0],
        'DeptID' => $faker->numberBetween($min = 1, $max = 9),
         'Description' => $faker->paragraph($nbSentences = 3, $variableNbSentences = true)
        
        
    ];
});