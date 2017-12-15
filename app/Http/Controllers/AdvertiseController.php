<?php

namespace App\Http\Controllers;

use App\Advertise;


class AdvertiseController extends Controller
{
    function getAdvertises()
    {
        return Advertise::all();
    }
}
