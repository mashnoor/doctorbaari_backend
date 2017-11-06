<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function signup(Request $request)
    {
        $name = $request->get('name');
        $medicalCollege = $request->get('medicalcollege');
        $regno = $request->get('regno');
        $contact = $request->get('contact');
        $designation = $request->get('designation');

        $user = new User();
        $user->fullname = $name;
        $user->college = $medicalCollege;
        $user->designation = $designation;
        $user->mbbs_reg = $regno;
        $user->phone = $contact;

        $user->create_date = date("Y-m-d");
        $user->save();
        return response()->json([
           "response" => "success",
            "user" => $user
        ]);
    }
}
