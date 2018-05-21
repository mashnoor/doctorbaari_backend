<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    function getNotifications()
    {
        return Notification::all();
    }
}
