<?php

use App\APIModels\Employee;
use App\APIModels\Branch;
use Faker\Generator as Faker;


$factory->define(App\APIModels\Department::class, function (Faker $faker) {
 
    return [
        'id' => $faker->unique()->numberBetween($min = 1, $max = 9000),
        'Name' => $faker->name,
         'MgrEmployeeID' => function(){
             return Employee::all()->random();
         },
        'MgStartDate' => $faker->date($format = 'Y-m-d', $max = 'now'),        
         'BranchID' => function(){
          return Branch::all()->random();
         }
       
        
    ];
});