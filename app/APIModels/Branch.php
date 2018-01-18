<?php

namespace App\APIModels;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    public function departments(){
    	return $this->hasmany(Department::class);
    }
}
