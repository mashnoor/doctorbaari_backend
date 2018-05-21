<?php

namespace App\Http\Controllers;


use App\WorkLocation;
use Illuminate\Http\Request;

class WorkLocationController extends Controller
{
                function getAllWorkLocation(Request $request)
    {
        $userid = $request->get('userid');

        $locations = WorkLocation::where('userid', $userid)->get();
        return $locations;
    }
}
