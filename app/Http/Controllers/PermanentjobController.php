<?php

namespace App\Http\Controllers;

use App\PermanentJob;
use App\User;
use Illuminate\Http\Request;

class PermanentjobController extends Controller
{
    function postPermanentJob(Request $request)
    {
        $post_date = date("Y-m-d");

        $deadline = $request->get('deadline');
        $details = $request->get('details');
        $hospital = $request->get('hospital');
        $placename = $request->get('placename');
        $degree = $request->get('degree');
        $placelat = $request->get('placelat');
        $placelon = $request->get('placelon');
        $userid = $request->get('userid');

        $user = User::find($userid);

        $permanentJob = new PermanentJob();
        $permanentJob->post_date = $post_date;
        $permanentJob->username = "null";
        $permanentJob->deadline = $deadline;
        $permanentJob->details = $details;
        $permanentJob->hospital = $hospital;
        $permanentJob->placename = $placename;

        $permanentJob->available = 1;
        $permanentJob->placelat = $placelat;
        $permanentJob->placelon = $placelon;
        $permanentJob->degree = $degree;
        $permanentJob->userid = $userid;
        $permanentJob->username = $user->fullname;

        $permanentJob->save();

        return "success";


    }

    function searchPermanentJob(Request $request)
    {
        $startingDate = $request->get('startingdate');
        $degree = $request->get('degree');
        $location = $request->get('location');

        $jobs = PermanentJob::where('deadline', '>=', $startingDate)->where('degree', '=', $degree)->where('location', '=', $location)->get();
        return $jobs;
    }
}
