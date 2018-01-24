<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\APIModels\Employee;

class EmployeeController extends Controller
{

    public function index(){
        return Employee::all()->toArray();
    }

   public function indexgetid(Request $request){

        if(\DB::table('employees')->where('EmailAddress', $request['email'])->first() == null){
            return response()->json([
                            'success' => 'invalid',
                            'message' => 'not a valid email',
                ]);
        }

        $fname = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->FirstName;
        $midname = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->MiddleName;
        $lastname = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->LastName;
        $dob = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->DOB;
        $email = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->EmailAddress;
        $workinghours = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->WorkingHours;
        $stdate = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->LastName;
        $category = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->Category;

        $depid = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->DeptID;

        $department = \DB::table('departments')->where('id', $depid)->first()->Name;
        $desc = \DB::table('employees')->where('EmailAddress', $email)->first()->Description;

        return response()->json([
                            'success' => 'valid',
                            'firstname' => $fname,
                            'middlename' => $midname,
                            'lastname' => $lastname,
                            'dob' => $dob,
                            'email' => $email,
                            'workinghours' => $workinghours,
                            'startdate' => $stdate,
                            'category' => $category,
                            'department' => $department,
                            'description' => $desc,
                ]);
    }

    public function getid(Request $request){
        if(\DB::table('employees')->where('EmailAddress', $request['email'])->first() == null){
            return response()->json([
                            'success' => 'invalid',
                            'message' => 'not a valid email',
                ]);
        }
        $id =  \DB::table('employees')->where('EmailAddress', $request['email'])->first()->EmployeeID;
            return response()->json([
                            'success' => 'valid',
                            'message' => $id,
                ]);

    }



}
