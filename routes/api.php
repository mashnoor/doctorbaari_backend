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
Route::post('/getnewsfeed', 'SubController@getNewsFeed');
Route::post('/postsub', 'SubController@postSub');
Route::post('/postpermanetjob', 'PermanentjobController@postPermanentJob');
Route::post('/verifyregno', 'VerificationController@verify');
Route::post('/getuser', 'UserController@getUser');
Route::post('/isnumberavailable', 'UserController@isNumberAvailableInDatabase');
Route::post('/updateuserprofile', 'UserController@updateUserProfile');
Route::post('/searchpermanentjob', 'PermanentjobController@searchPermanentJob');
Route::get('/getcollegelist', 'PermanentjobController@getCollegeList');
Route::post('/changestatus', 'UserController@changeAvaibilityStatus');
Route::post('/searchavailabledoctors', 'UserController@searchAvailableDoctors');
Route::post('/gethistory', 'UserController@getUsersPostedJobs');
Route::post('/addtoavaibility', 'UserController@addToAvaibilityList');
Route::post('/getavaibilitylist', 'UserController@getAvaibilityList');
Route::post('/searchsubstitutejob', 'SubController@searchSubJobs');

//Review Routes
Route::post('/makereview', 'ReviewController@makeReview');
Route::post('/getreviews', 'ReviewController@getReviews');
Route::get('/getadvertises', 'AdvertiseController@getAdvertises');
Route::post('/inquiry', 'InquiryController@getUsersList');

//Profile Update APIs
Route::post('/addupdateworklocation', 'UserController@addUpdateWorkLocation');
Route::post('/updatedegree', 'UserController@updateDegrees');
Route::post('/getworklocations', 'WorkLocationController@getAllWorkLocation');

//Update Job Availability
Route::post('/updatejobavailability', 'UserController@updateJobAvailability');

//Get Notifications
Route::get('/getnotifications', 'NotificationController@getNotifications');