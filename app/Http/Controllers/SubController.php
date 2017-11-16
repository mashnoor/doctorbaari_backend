<?php

namespace App\Http\Controllers;

use App\Sub;
use Illuminate\Http\Request;

class SubController extends Controller
{
    function getAllSubs()
    {
        return Sub::all();
    }

    function postSub(Request $request)
    {

        $date_to = $request->date_to;
        $date_from = $request->date_from;
        $division = $request->division;
        $zilla = $request->zilla;
        $thana = $request->thana;
        $username = $request->username;
        $hospital = $request->hospital;
        $details = $request->details;

        $sub = new Sub();
        $sub->post_date = date("Y-m-d");
        $sub->date_to = $date_to;
        $sub->date_from = $date_from;
        $sub->division = $division;
        $sub->username = $username;
        $sub->day_month = "day";
        $sub->zilla = $zilla;
        $sub->thana = $thana;
        $sub->duration = strtotime($date_to) - strtotime($date_from);
        $sub->hospital_name = $hospital;
        $sub->details = $details;
        $sub->available = 1;
        $sub->payment = 0;
        $sub->save();

        return "success";


    }
}
