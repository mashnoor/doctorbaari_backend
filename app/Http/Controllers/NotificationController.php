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

    function sendNotification(Request $request)
    {
        $title = $request->get('title');
        $body = $request->get('body');
        $date = date('Y-m-d');

        $notification = new Notification();
        $notification->title = $title;
        $notification->body = $body;
        $notification->post_date = $date;;
        $notification->save();

        return 'success';
    }
}
