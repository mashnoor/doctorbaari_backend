<?php


use Illuminate\Support\Facades\Route;

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
Route::post('/isnumberavailable', 'UserController@isNumberAvailableInDatabase');
Route::post('/updateuserprofile', 'UserController@updateUserProfile');
Route::post('/searchpermanentjob', 'PermanentjobController@searchPermanentJob');
Route::get('/getcollegelist', 'PermanentjobController@getCollegeList');
Route::post('/changestatus', 'PermanentjobController@changeAvaibilityStatus');