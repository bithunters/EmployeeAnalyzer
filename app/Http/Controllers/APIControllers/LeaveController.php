<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\APIModels\Leave;

class LeaveController extends Controller
{


	public function index(){
		return Leave::all();
	}
	public function indexgetid($id){
		return \DB::table('leaves')->where('LeaveID', $id)->first()->AcceptReject;
	}

     public function apply(Request $request){
     	$validate = $this->validate($request, [

         'AppliedTime' => 'required',
         'LeaveDate' => 'required',
         'AcceptReject' => 'required',
         'EmpEmail' => 'required',
         'LeaveType' => 'required',
     ]);
     	$id = rand(1, 9000);
     	//return $request['EmpEmail']." ".\DB::table('employees')->where('EmailAddress', $request['EmpEmail'])->first();
     	if(\DB::table('employees')->where('EmailAddress', $request['EmpEmail'])->first() == null || \DB::table('leavetypes')->where('Name', $request['LeaveType'])->first() == null){
     		return 'employee has not in database or invalid leave type';
     	}else{
     		$EmpID = \DB::table('employees')->where('EmailAddress', $request['EmpEmail'])->first()->EmployeeID; 
     		$LeaveTypeID =\DB::table('leavetypes')->where('Name', $request['LeaveType'])->first()->LeaveTypeID;
     	}
     	

     	while(\DB::table('leaves')->where('LeaveID', $id)->first() != null){

     		$id = rand(1, 9000);

     	}
     	if($validate == null){

    		$leave = new Leave();
            $leave->LeaveID= $id;
            $leave->AppliedTime= $request['AppliedTime'];
            $leave->LeaveDate= $request['LeaveDate'];
            $leave->AcceptReject= $request['AcceptReject'];
            $leave->EmpID= $EmpID;
            $leave->LeaveTypeID= $LeaveTypeID;

            $leave->save();
            return 'successfull';

    }
   }
}
