<?php

namespace App\Http\Controllers;

use App\PermanentJob;
use Illuminate\Http\Request;

class PermanentjobController extends Controller
{
    function postPermanentJob(Request $request)
    {
        $post_date = date("Y-m-d");

        $deadline = $request->get('deadline');
        $details = $request->get('details');
        $hospital = $request->get('hospital');
        $division = $request->get('division');
        $degree = $request->get('degree');

        $permanentJob = new PermanentJob();
        $permanentJob->post_date = $post_date;
        $permanentJob->username = "null";
        $permanentJob->deadline = $deadline;
        $permanentJob->details = $details;
        $permanentJob->hospital = $hospital;
        $permanentJob->division = $division;
        $permanentJob->zilla = "null";
        $permanentJob->thana = "null";
        $permanentJob->available = 1;

        $permanentJob->save();

        return "success";


    }
}
