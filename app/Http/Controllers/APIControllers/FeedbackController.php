<?php

namespace App\Http\Controllers\APIControllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\APIModels\Feedback;
class FeedbackController extends Controller
{
	public function getfeedback(){
		return Feedback::all()->toArray();
	}
    
}
