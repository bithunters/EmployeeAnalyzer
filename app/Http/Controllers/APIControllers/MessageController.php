<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\APIModels\Message;
use App\APIModels\Employee;


class MessageController extends Controller
{
	
	public function index(){
		return Message::all();
	}
	public function indexgetid($id){
		return Employee::find($id)->messages;
	}
    public function store(Request $request){
    	$validate = $this->validate($request, [

         'sender' => 'required',
         'reciever' => 'required',
         'time' => 'required',
         'date' => 'required',
         'content' => 'required',
     ]);

    	if($validate != null){

    		return 'one or more field required';
    	}else{

    		$sender = \DB::table('employees')->where('EmailAddress', $request['sender'])->first();
    		$reciever = \DB::table('employees')->where('EmailAddress', $request['reciever'])->first();
    		if ($sender == null || $reciever == null) {
    		return 'not a valid sender or reciever';
    		} else {
    			$message = new Message();
            	$message->SenderID= $sender->EmployeeID;
            	$message->ReceiverID= $reciever->EmployeeID;
            	$message->Time= $request['time'];
            	$message->Date= $request['date'];
            	$message->Content= $request['content'];

            	$message->save();
            	return 'successfull';
    		}
    	}
    	
    	


    }
}
