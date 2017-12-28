<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\HelperController;

class InquiryController extends Controller
{



    function cmp($user1, $user2)
    {
        if ($user1->distance == $user2->distance) return 0;
        if ($user1->distance < $user2->distance) return -1;
        return 1;

    }

    function getUsersList(Request $request)
    {

        $placelat = doubleval($request->get('placelat'));
        $placelon = doubleval($request->get('placelon'));
        $usersAll = User::all();
        $nearUsers = array();
        foreach ($usersAll as $user) {
            $currUserLat = doubleval($user->placelat);
            $currUserLon = doubleval($user->placelon);
            $distance = HelperController::distance($placelat, $placelon, $currUserLat, $currUserLon, "K");
            if ($distance <= 0.2) {
                $user->distance = $distance;
                array_push($nearUsers, $user);
            }
        }

        //Sort the users according to distance
        usort($nearUsers, array($this, "cmp"));


        return $nearUsers;
    }
}
