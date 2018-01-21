<?php

namespace App\APIModels;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
	
    public function messages(){

   	return $this->hasMany(Message::class);
   }
}
