<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\APIModels\Attendencerecord;
use App\APIModels\User;

class AtendencerecordController extends Controller
{
    
    public function index(){
        return Attendencerecord::all();
    }
    public function indexgetid($id){

        return Attendencerecord::find($id);
    }
    public function delete($id){
        \DB::table('attendencerecords')->where('EmpID', '=', $id)->delete();
        return response()->json([
                            'success' => 'successful',
                            'message' => 'employee has been deleted',
                ]);
    }
    public function store(Request $request){
        $validate = $this->validate($request, [
            
        'email' => 'required',  
         'RecordTime' => 'required',
         'Date' => 'required',
         'IsAvailable' => 'required',
         'Description' => 'required',
         ]);
        if(\DB::table('employees')->where('EmailAddress', $request['email'])->first() == null){
            return response()->json([
                            'success' => 'invalid',
                            'message' => 'employee has not in database',
                ]);
        }
        $userid = \DB::table('employees')->where('EmailAddress', $request['email'])->first()->EmployeeID;
        $record = new Attendencerecord();
                $record->EmpID= $userid;
                $record->RecordTime= $request['RecordTime'];
                $record->Date= $request['Date'];
                $record->IsAvailable= $request['IsAvailable'];
                $record->Description= $request['Description'];

                $record->save();
                return response()->json([
                            'success' => 'successful',
                            'message' => 'record successfully',
                ]);
    }

}
