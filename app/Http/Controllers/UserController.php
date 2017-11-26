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


        $user = new User();
        $user->fullname = $name;
        $user->college = $medicalCollege;
        $user->designation = $designation;
        $user->mbbs_reg = $regno;
        $user->phone = $contact;
        $user->birthdate = $dateofbirth;
        $user->work1 = $location;
        $user->create_date = date("Y-m-d");
        $user->save();
        return response()->json([
            "response" => "success",
            "user" => $user
        ]);
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
        return "true";
    }
}
