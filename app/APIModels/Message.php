<?php

namespace App\APIModels;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
   public function employee(){

   	return $this->belongsTo(Employee::class);
   }
}
