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

Route::post('/signup', 'UserController@signupMBBS');
Route::get('/getsubs', 'SubController@getAllSubs');
Route::post('/postsub', 'SubController@postSub');
Route::post('/postpermanetjob', 'PermanentjobController@postPermanentJob');
Route::post('/verifyregno', 'VerificationController@verify');
Route::post('/getuser', 'UserController@getUser');