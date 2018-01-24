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
        return Employee::find($id);
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

            return response()->json([
                            'success' => 'unsuccess',
                            'message' => 'one or more field is required',
                        ]);
        }else{

            $sender = \DB::table('employees')->where('EmailAddress', $request['sender'])->first();
                $reciever = \DB::table('users')->where('email', $request['reciever'])->first();
            if ($sender == null) {
            return response()->json([
                            'success' => 'unsuccess',
                            'message' => 'not a valid sender',
                ]);
            }else if ($reciever == null) {
            return response()->json([
                            'success' => 'unsuccess',
                            'message' => 'not a valid reciever',
                ]);
            } else {
                $message = new Message();
                $message->SenderID= $sender->EmployeeID;
                $message->ReceiverID= $reciever->id;
                $message->Time= $request['time'];
                $message->Date= $request['date'];
                $message->Content= $request['content'];

                $message->save();
                return response()->json([
                            'success' => 'successful',
                            'message' => 'message sent successfully',
                ]);;
            }
        }
        
        


    }
}
