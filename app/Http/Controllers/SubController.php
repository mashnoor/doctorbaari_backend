<?php

namespace App\Http\Controllers;

use App\Avaibility;
use App\Sub;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubController extends Controller
{
    function getAllSubs()
    {
        return Sub::all();
    }

    function postSub(Request $request)
    {


        $date_to = $request->get('date_to');
        $date_from = $request->get('date_from');
        $place = $request->get('place');
        $placelat = $request->get('placelat');
        $placelon = $request->get('placelon');
        $institute = $request->get('institute');
        $details = $request->get('details');
        $userid = $request->get('userid');
        $degree = $request->get('degree');

        $user = User::find($userid);


        $sub = new Sub();
        $sub->post_datetime = Carbon::now()->toDateTimeString();
        $sub->date_to = $date_to;
        $sub->date_from = $date_from;
        $sub->place = $place;
        $sub->username = $user->username;
        $sub->userid = $userid;
        $sub->placelat = $placelat;
        $sub->placelon = $placelon;
        $sub->duration = strtotime($date_to) - strtotime($date_from);
        $sub->institute = $institute;
        $sub->details = $details;
        $sub->available = 1;
        $sub->degree = $degree;

        $sub->save();

        return "success";


    }

    function searchSub(Request $request)
    {
        $fromDate = $request->get('fromdate');
        $toDate = $request->get('todate');
        $place = $request->get('place');
        $placelat = $request->get('placelat');
        $placelon = $request->get('placelon');
        $degree = $request->get('degree');
        $userid = $request->get('userid');
        $avaibilities = Avaibility::where('available', '=', '1')->get();
        $available_users = array();
        foreach ($avaibilities as $avaibility)
        {
            $userid = $avaibility->userid;
            $user = User::find($userid);
            array_push($available_users, $user);
        }

        return $available_users;
    }
}
