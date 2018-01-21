<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\APIModels\Branch;
use App\APIModels\Employee;
use App\APIModels\Department;

class UsersController extends Controller
{
    public function index(){
    	return Employee::all();
    }

	public function indexgetid($id){

    	return \DB::table('employees')->where('EmployeeID', $id)->first()->FirstName;
    }

    
}
