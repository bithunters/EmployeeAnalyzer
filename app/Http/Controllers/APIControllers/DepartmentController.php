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
    public function indexgetid($id){
    	return \DB::table('departments')->where('id', $id)->first()->Name;
    }
}
