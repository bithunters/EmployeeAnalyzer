<?php

namespace App\APIModels;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model

{
	// protected $table = 'employees';
	// protected $fillable=['EmployeeID'];
	protected $primaryKey = "EmployeeID";
    public function messages(){

   	return $this->hasMany(Message::class);
   	
   }
}
