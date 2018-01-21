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
Route::middleware('auth:api')->post('/loginattempt', 'APIControllers\UsersLoginController@loginAttempt');

Route::get('/user', 'APIControllers\UsersController@index');
Route::post('/user/{id}', 'APIControllers\UsersController@indexgetid');
Route::get('/department', 'APIControllers\DepartmentController@index');
Route::post('/department/{id}', 'APIControllers\DepartmentController@indexgetid');

Route::post('/leaveapply', 'APIControllers\LeaveController@apply');
Route::get('/leaves', 'APIControllers\LeaveController@index');
Route::post('/leaves/{id}', 'APIControllers\LeaveController@indexgetid');

Route::post('/sendmessage', 'APIControllers\MessageController@store');
Route::get('/messages', 'APIControllers\MessageController@index');
Route::get('/messages/{id}', 'APIControllers\MessageController@indexgetid');