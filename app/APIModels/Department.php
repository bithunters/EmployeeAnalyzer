<?php

namespace App\APIModels;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function branch(){
    	return $this->belongsTo(Branch::class);
    }
}
