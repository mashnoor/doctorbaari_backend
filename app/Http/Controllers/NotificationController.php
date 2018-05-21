<?php

namespace App\Http\Controllers;

use App\Notification;
use App\User;
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
        $this->sendPush($title, $body);

        return 'success';
    }

    function sendPush($title, $body)
    {
        // API access key from Google API's Console
        define('API_ACCESS_KEY', 'AAAAGHmjY8k:APA91bG31Xjl445W5JJCLtY8AiUJBEESGtidyApGwWJUskXDnrz1-FSEQ6ZfWAjhbEHDDx6wwLRReG496UeFlgIuho4dinV7rQWuY1Ljt9CAgxtoOHgs6UZ5VcshE7yxCflnxkdjlSXp');
        $registrationIds = User::all()->pluck('token')->toArray();
// prep the bundle
        $msg = array
        (
            'body' => $body,
            'title' => $title,
        );
        $fields = array
        (
            'registration_ids' => $registrationIds,
            'data' => $msg
        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    }
}
