<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/loginattempt', 'APIControllers\UsersLoginController@loginAttempt');



// Route::get('/users', 'APIControllers\EmployeeController@index');
// Route::post('/user', 'APIControllers\EmployeeController@indexgetid');
//Route::post('/employeeregister', 'APIControllers\EmployeeController@register');

Route::get('/employees', 'APIControllers\EmployeeController@index');
Route::post('/employee', 'APIControllers\EmployeeController@indexgetid');
Route::post('/employeegetid', 'APIControllers\EmployeeController@getid');

Route::get('/department', 'APIControllers\DepartmentController@index');
Route::post('/department/{name}', 'APIControllers\DepartmentController@indexgetid');
Route::post('/getdepartmentid', 'APIControllers\DepartmentController@getdepartmentid');


Route::post('/leaveapply', 'APIControllers\LeaveController@apply');
Route::get('/leaves', 'APIControllers\LeaveController@index');
Route::post('/leaves/{employee}', 'APIControllers\LeaveController@indexgetid');
Route::post('/leavestatus', 'APIControllers\LeaveController@leavestatus');
Route::post('/availableleaves', 'APIControllers\LeaveController@availableleaves');
Route::post('/leavestatus', 'APIControllers\LeaveController@leavestatus');

Route::post('/sendmessage', 'APIControllers\MessageController@store');
Route::get('/messages', 'APIControllers\MessageController@index');
Route::get('/messages/{id}', 'APIControllers\MessageController@indexgetid');

Route::post('/attendencerecord', 'APIControllers\AtendencerecordController@store');
Route::post('/deleterecord/{id}', 'APIControllers\AtendencerecordController@delete');
Route::get('/viewrecord', 'APIControllers\AtendencerecordController@index');
Route::post('/viewrecord/{id}', 'APIControllers\AtendencerecordController@indexgetid');

Route::post('/givefeedback', 'APIControllers\FeedbackController@givefeedback');
Route::post('/getfeedback', 'APIControllers\FeedbackController@getfeedback');




