<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\APIModels\Department;

class DepartmentController extends Controller
{
    public function index(){
        return Department::all();
    }
    public function indexgetid($name){
        if(\DB::table('departments')->where('Name', $name)->first() == null){
            return response()->json([
                            'success' => 'invalid',
                            'message' => 'department has not in database',
                ]);
        }
        $dep = \DB::table('departments')->where('Name', $name)->first();
        $manager = \DB::table('employees')->where('EmployeeID',$dep->MgrEmployeeID)->first()->FirstName;
        $branch = \DB::table('branches')->where('id',$dep->BranchID)->first()->Name;

        return response()->json([
                            'success' => 'valid',
                            'name' => $dep->Name,
                            'manager' => $manager,
                            'managerstartdate' => $dep->MgStartDate,
                            'branch' => $branch,
                ]);
    }
    public function getdepartmentid(Request $request){
        if(\DB::table('departments')->where('Name', $request['name'])->first() == null){
            return response()->json([
                            'success' => 'invalid',
                            'message' => 'department has not in database',
                ]);
        }
        $depid = \DB::table('departments')->where('Name', $request['name'])->first()->id;
        return response()->json([
                            'success' => 'valid',
                            'message' => $depid,
                ]);
    }
}
