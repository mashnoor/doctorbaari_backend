<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VerificationController extends Controller
{
    function verify(Request $request)
    {
        $regNo = $request->get('regno');

    }
}
