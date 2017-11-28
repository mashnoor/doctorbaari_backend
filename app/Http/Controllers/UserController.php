<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function signupMBBS(Request $request)
    {
        $name = $request->get('name');
        $medicalCollege = $request->get('medicalcollege');
        $regno = $request->get('regno');
        $contact = $request->get('contact');
        $designation = $request->get('designation');
        $dateofbirth = $request->get('dateofbirth');
        $location = $request->get('worklocation');
        $workinglat = $request->get('workinglat');
        $workinglon = $request->get('workinglon');

        $dummyUser = User::where('phone', '=', $contact)->first();
        if(!is_null($dummyUser))
        {
            return "occupied";
        }

        $user = new User();
        $user->fullname = $name;
        $user->college = $medicalCollege;
        $user->designation = $designation;
        $user->mbbs_reg = $regno;
        $user->phone = $contact;
        $user->birthdate = $dateofbirth;
        $user->work1 = $location;
        $user->create_date = date("Y-m-d");
        $user->workinglat = $workinglat;
        $user->workinglon = $workinglon;
        $user->save();
        return $user->id;
    }

    function getUser(Request $request)
    {
        $userId = $request->get('userid');
        $user = User::find($userId);
        return $user;
    }

    function isNumberAvailableInDatabase(Request $request)
    {
        $phone = $request->get('phone');
        $user = User::where('phone', '=', $phone)->first();
        if(is_null($user))
        {
            return "false";
        }
        return $user->id;
    }
    function updateUserProfile(Request $request)
    {
        $id = $request->get('userid');
        $email = $request->get('email');
        $publicLink = $request->get('link');
        $pictureUrl = $request->get('picture_url');
        $user = User::find($id);
        $user->email = $email;
        $user->fb_profile = $publicLink;
        $user->pp_url = $pictureUrl;

        $user->save();
        return "success";

    }

    function changeAvaibilityStatus(Request $request)
    {
        $user = User::find($request->get('userid'));
        $user->available = $request->get('status');
        $user->from_date = $request->get('from_date');
        $user->to_date = $request->get('to_date');
        $user->save();
        return "done";
    }
}
