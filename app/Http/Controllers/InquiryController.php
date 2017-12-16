<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    function getUsersList(Request $request)
    {
        $placeName = $request->get('place');
        $users = User::where('place', '=', $placeName)->get();

        return $users;
    }
}
