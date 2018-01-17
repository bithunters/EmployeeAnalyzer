<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\APIModels;

class UsersController extends Controller
{
    public function index(){
    	return User::all();
    }
}
