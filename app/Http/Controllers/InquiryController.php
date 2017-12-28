<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class InquiryController extends Controller
{

    function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

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
            $distance = $this->distance($placelat, $placelon, $currUserLat, $currUserLon, "K");
            if ($distance <= 0.2) {
                $user['distance'] = $distance;
                array_push($nearUsers, $user);
            }
        }

        //Sort the users according to distance
        usort($usersAll, "cmp");


        return $nearUsers;
    }
}
