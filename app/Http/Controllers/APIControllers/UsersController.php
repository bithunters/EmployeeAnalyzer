<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\APIModels\Branch;

use App\APIModels\Department;

class UsersController extends Controller
{
    public function index(){
    	return User::all();
    }

    public function department(){
    	return Branch::find(4)->departments;
    }
}
