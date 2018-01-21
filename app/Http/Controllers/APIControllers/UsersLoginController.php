<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\APIModels\User;


class UsersLoginController extends Controller
{
    public function loginAttempt(Request $request){

    	 $userid = $request->input('useremail');
    	 $password = $request->input('password');
    	

    	if(\DB::table('users')->where('email', $userid)->first() != null ){
            
    		$password_d = \DB::table('users')->where('email', $userid)->first()->password;
    		
        		if($password == $password_d){
        			return 'valid';
        		}else{
        			return 'email or password invalid';
        		}
    		
    	} else{

    		    return 'email or password invalid';
    	}
    	

    	
    }
}
