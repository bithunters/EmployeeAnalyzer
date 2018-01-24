<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\APIModels\User;
use Auth;

class UsersLoginController extends Controller
{
    public function loginAttempt(Request $request){

         $userid = $request->input('useremail');
         $password = $request->input('password');

        if(\DB::table('employees')->where('EmailAddress', $userid)->first() != null ){
            
            $password_d = \DB::table('employees')->where('EmailAddress', $userid)->first()->Password;
            
                if($password == $password_d){
                    return response()->json([
                            'success' => 'valid',
                            'message' => 'validation successful',
                ]);
                }else{
                    return response()->json([
                            'success' => 'invalid',
                            'message' => 'email or password invalid',
                ]);
                }
            
        } else{

                return response()->json([
                            'success' => 'invalid',
                            'message' => 'email or password invalid',
                ]);
        }
        

        
    }
}
