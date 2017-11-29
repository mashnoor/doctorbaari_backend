<?php

namespace App\Http\Controllers;

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

        $sub->save();

        return "success";


    }
}
