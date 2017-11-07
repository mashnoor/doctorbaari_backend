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
}
