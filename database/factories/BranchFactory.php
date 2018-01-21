<?php
use Faker\Generator as Faker;


$factory->define(App\APIModels\Branch::class, function (Faker $faker) {
 
    return [
    	'id' => $faker->unique()->numberBetween($min = 1, $max = 9000),
        'Name' => $faker->name,
        'Number' => $faker->tollFreePhoneNumber,
        'Street' => $faker->streetName,
        'City' => $faker->city,
        'StartDate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        
        
    ];
});