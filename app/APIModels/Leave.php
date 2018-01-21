<?php

namespace App\APIModels;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
   
	protected $fillable = [
        'LeaveID', 'AppliedTime', 'LeaveDate','AcceptReject','EmpID','LeaveTypeID',
    ];
}
