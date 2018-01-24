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
    public function indexgetid($employee){
        if(\DB::table('employees')->where('EmailAddress', $employee)->first() == null){
            return response()->json([
                            'success' => 'invalid',
                            'message' => 'employee has not in database',
                ]);
        }
        $empid = \DB::table('employees')->where('EmailAddress', $employee)->first()->EmployeeID;
        
        $leave = \DB::table('leaves')->where('EmpID', $empid)->first();
        return response()->json([
                            'success' => 'valid',
                            'leaveid' => $leave->LeaveID,
                            'appliedtime' => $leave->AppliedTime,
                            'leavestartdate' => $leave->LeaveStartDate,
                            'numberOfdays' => $leave->NumberOfDays,
                            'acceptreject' => $leave->AcceptReject,
                            'empid' => $depid,
                            'leavetypeid' => $leave->LeaveTypeID,

                ]);
        
    }
    public function availableleaves(Request $request){
        if(\DB::table('employees')->where('EmailAddress', $request['email'])->first() == null){
            return response()->json([
                            'success' => 'unsuccess',
                            'message' => 'not a valid employee',
                ]);
        }
        
        $totalmedical = \DB::table('leavetypes')->where('Name', 'medical')->first()->LeaveTotal;
        $totalannual = \DB::table('leavetypes')->where('Name', 'annual')->first()->LeaveTotal;
        $totalcasual = \DB::table('leavetypes')->where('Name', 'casual')->first()->LeaveTotal;
        $empid = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->EmployeeID;

        $annualleaveid = \DB::table('leavetypes')->where('Name', 'annual')->first()->LeaveTypeID;
        $medicalleaveid = \DB::table('leavetypes')->where('Name', 'medical')->first()->LeaveTypeID;
        $casualleaveid = \DB::table('leavetypes')->where('Name', 'casual')->first()->LeaveTypeID;

        $eleaveid = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->EmployeeID;

        $usertotalmedical = 0;
        $usertotalannual = 0;
        $usertotalcasual = 0;
        $medicalleaves = \DB::table('leaves')->where([
                    ['AcceptReject', '=', 'accept'],
                    ['EmpID', '=', $empid],
                    ['LeaveTypeID', '=',  $medicalleaveid]
                    ])->get();
       
        foreach ($medicalleaves as $medicatleave) {

                    $usertotalmedical = $usertotalmedical + $medicatleave->NumberOfDays;

                    }
        $annualleaves = \DB::table('leaves')->where([
                    ['AcceptReject', '=', 'accept'],
                    ['EmpID', '=', $empid],
                    ['LeaveTypeID', '=', $annualleaveid]
                    ])->get();
        foreach ($annualleaves as $annualleave) {

                    $usertotalannual = $usertotalannual + $annualleave->NumberOfDays;

                    }
        $casualleaves = \DB::table('leaves')->where([
                    ['AcceptReject', '=', 'accept'],
                    ['EmpID', '=', $empid],
                    ['LeaveTypeID', '=', $casualleaveid]
                    ])->get();
        foreach ($casualleaves as $casualleave) {

                    $usertotalcasual = $usertotalcasual + $casualleave->NumberOfDays;

                    }
                    $usertotalmedical = $totalmedical - $usertotalmedical;
                    $usertotalannual = $totalannual -  $usertotalannual;
                    $usertotalcasual = $totalcasual - $usertotalcasual;
                    return response()->json([
                            'success' => 'success',
                            'remaining medical' => $usertotalmedical,
                            'remaining annual' => $usertotalannual,
                            'remaining casual' => $usertotalcasual,
                ]);
        
    }

     public function apply(Request $request){
        $validate = $this->validate($request, [

         'appliedtime' => 'required',
         'leavedate' => 'required',
         'empemail' => 'required',
         'leavetype' => 'required',
         'noofdays' => 'required',
     ]);
        $id = rand(1, 9000);
        
        while(\DB::table('leaves')->where('LeaveID', $id)->first() != null){

            $id = rand(1, 9000);

        }
        //return $request['EmpEmail']." ".\DB::table('employees')->where('EmailAddress', $request['EmpEmail'])->first();
        
        if(\DB::table('employees')->where('EmailAddress', $request['empemail'])->first() == null){
            return response()->json([
                            'success' => 'invalid',
                            'message' => 'employee has not in database',
                ]);
        }else if(\DB::table('leavetypes')->where('Name', $request['leavetype'])->first() == null){
            return response()->json([
                            'success' => 'invalid',
                            'message' => 'invalid leave type',
                ]);
        }else if(\DB::table('leavetypes')->where('Name', $request['leavetype'])->first()->LeaveTotal < (int)$request['noofdays']){
            return response()->json([
                            'success' => 'invalid',
                            'message' => 'you have taken the total no of leaves in this type',
                ]);
        }else{
            $EmpID = \DB::table('employees')->where('EmailAddress', $request['empemail'])->first()->EmployeeID; 
            $LeaveTypeID =\DB::table('leavetypes')->where('Name', $request['leavetype'])->first()->LeaveTypeID;
            //$leaves = \DB::table('leaves')->where('AcceptReject','=', 'accept');
            
            
            switch ($request['leavetype']) {
                case 'medical':
                    $medicalleaves = \DB::table('leaves')->where([
                    ['AcceptReject', '=', 'accept'],
                    ['EmpID', '=', $EmpID],
                    ['LeaveTypeID', '=', \DB::table('leavetypes')->where('Name', $request['leavetype'])->first()->LeaveTypeID],
                    ])->get();
                    
                    $totalmedical = 0;
                    foreach ($medicalleaves as $medicatleave) {

                    $totalmedical = $totalmedical + $medicatleave->NumberOfDays;

                    }
                    $totalmedical = $totalmedical + (int)$request['noofdays'];
                    if(\DB::table('leavetypes')->where('Name', $request['leavetype'])->first()->LeaveTotal < $totalmedical){
                        return response()->json([
                            'success' => 'invalid',
                            'message' => 'you have taken the total no of leaves in this type',
                    ]);


            }

                    break;

                case 'annual':
                    $annualleaves = \DB::table('leaves')->where([
                    ['AcceptReject', '=', 'accept'],
                    ['EmpID', '=', $EmpID],
                    ['LeaveTypeID', '=', \DB::table('leavetypes')->where('Name', $request['leavetype'])->first()->LeaveTypeID],
                    ])->get();
                    
                    $totalannual = 0;
                    foreach ($annualleaves as $annualleave) {

                    $totalannual = $totalannual + $annualleave->NumberOfDays;

                    
                    }
                    $totalannual = $totalannual + (int)$request['noofdays'];

                    if(\DB::table('leavetypes')->where('Name', $request['leavetype'])->first()->LeaveTotal < $totalannual){
                        return response()->json([
                            'success' => 'invalid',
                            'message' => 'you have taken the total no of leaves in this type',
                        ]);

            }
                    break;

                case 'casual':
                    $casualleaves = \DB::table('leaves')->where([
                    ['AcceptReject', '=', 'accept'],
                    ['EmpID', '=', $EmpID],
                    ['LeaveTypeID', '=', \DB::table('leavetypes')->where('Name', $request['leavetype'])->first()->LeaveTypeID],
                    ])->get();
                    
                    $totalcasual = 0;
                    foreach ($casualleaves as $casualleave) {

                    $totalcasual = $totalcasual + $casualleave->NumberOfDays;

                    
                    }
                    $totalcasual = $totalcasual + (int)$request['noofdays'];;
                    if(\DB::table('leavetypes')->where('Name', $request['leavetype'])->first()->LeaveTotal < $totalcasual){
                        return response()->json([
                            'success' => 'invalid',
                            'message' => 'you have taken the total no of leaves in this type',
                        ]);

            }
                    break;
            }
        }

        
        if($validate == null){

            $leave = new Leave();
            $leave->LeaveID = $id;
            $leave->AppliedTime= $request['appliedtime'];
            $leave->LeaveStartDate= $request['leavedate'];
            $leave->AcceptReject= null;
            $leave->NumberOfDays= $request['noofdays'];;
            $leave->EmpID= $EmpID;
            $leave->LeaveTypeID= $LeaveTypeID;

            $leave->save();
            return response()->json([
                            'success' => 'valid',
                            'message' => 'leave record added successful',
                ]);
    }
   }
   public function leavestatus(Request $request){
    $data = timestamp(convert_datetime('2008-05-10 20:56:00')). '  '. convert_datetime('2008-05-10 20:56:00') . ' 1210467360';
    return $data;
    if(\DB::table('employees')->where('EmailAddress', $request['email'])->first() == null){
            return response()->json([
                            'success' => 'invalid',
                            'message' => 'not a valid email',
                ]);
        }
        
    }
}
