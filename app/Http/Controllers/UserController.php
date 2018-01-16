<?php

namespace App\Http\Controllers;

use App\Avaibility;

use App\PermanentJob;
use App\Sub;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use Illuminate\Http\File;

use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function signupMBBS(Request $request)
    {
        $name = $request->get('username');
        $medicalCollege = $request->get('medicalcollege');
        $regno = $request->get('regno');
        $contact = $request->get('contact');
        $degree = $request->get('degree');
        $image_link = "Not Available";
        if ($request->hasFile('imagefile')) {
            $fileName = $this->generateRandomString();
            Storage::putFileAs(
                'public', $request->file('imagefile'), $fileName . "_interncertificate.jpg"
            );

            $image_link = "https://doctorbaari.com:1234/storage/" . $fileName . "_permanentjobimage.jpg";

        }
        $place = $request->get('place');
        $placelat = $request->get('placelat');
        $placelon = $request->get('placelon');
        $type = $request->get('type');
        $email = $request->get('email', 'Not Available');
        $publicLink = $request->get('link', 'Not Available');
        $pictureUrl = $request->get('picture_url', 'Not Available');


        $dummyUser = User::where('phone', '=', $contact)->first();
        if (!is_null($dummyUser)) {
            return "occupied";
        }

        $user = new User();
        $user->username = $name;
        $user->college = $medicalCollege;
        $user->degree = $degree;
        $user->mbbs_reg = $regno;
        $user->phone = $contact;
        $user->certificate_image = $image_link;
        $user->place = $place;
        $user->created_at = Carbon::now()->toDateTimeString();
        $user->placelat = $placelat;
        $user->placelon = $placelon;
        $user->type = $type;
        $user->email = $email;
        $user->fb_profile = $publicLink;
        $user->pp_url = $pictureUrl;
        $user->available = "0";
        $user->save();
        return $user->id;
    }

    function getUser(Request $request)
    {
        $userId = $request->get('userid');
        $user = User::find($userId);
        return $user;
    }

    function isNumberAvailableInDatabase(Request $request)
    {
        $phone = $request->get('phone');
        $user = User::where('phone', '=', $phone)->first();
        if (is_null($user)) {
            return "false";
        }
        return $user->id;
    }

    function updateUserProfile(Request $request)
    {
        $id = $request->get('userid');
        $email = $request->get('email');
        $publicLink = $request->get('link');
        $pictureUrl = $request->get('picture_url');
        $user = User::find($id);
        $user->email = $email;
        $user->fb_profile = $publicLink;
        $user->pp_url = $pictureUrl;

        $user->save();
        return "success";

    }

    function addToAvaibilityList(Request $request)
    {
        $userid = $request->get('userid');
        $fromdate = $request->get('fromdate');
        $todate = $request->get('todate');
        $place = $request->get('place');
        $placelat = $request->get('placelat');
        $placelon = $request->get('placelon');
        $available = $request->get('available');
        $type = $request->get('type');

        $avaibility = new Avaibility();
        $avaibility->from_date = $fromdate;
        $avaibility->to_date = $todate;
        $avaibility->place = $place;
        $avaibility->placelat = $placelat;
        $avaibility->placelon = $placelon;
        $avaibility->post_datetime = Carbon::now()->toDateTimeString();
        $avaibility->available = $available;
        $avaibility->userid = $userid;
        $avaibility->type = $type;

        $avaibility->save();

        return "success";


    }

    function changeAvaibilityStatus(Request $request)
    {
        $id = $request->get('availability_id');
        $status = $request->get('status');

        $available = Avaibility::find($id);
        $available->available = $status;
        $available->save();

        return "done";
    }

    function getUsersPostedJobs(Request $request)
    {
        $userid = $request->get('userid');
        $type = $request->get('type');
        if (strcmp($type, "sub") == 0) {
            $subPosts = Sub::where('userid', '=', $userid)->orderBy('post_datetime', 'DESC')->get();
            return $subPosts;
        } else {
            $permanentPosts = PermanentJob::where('userid', '=', $userid)->orderBy('post_datetime', 'DESC')->get();
            return $permanentPosts;
        }


    }

    function getAvaibilityList(Request $request)
    {
        $userid = $request->get('userid');
        $type = $request->get('type', 'all');

        if (!strcmp($type, "all") == 0)
            return Avaibility::where('userid', '=', $userid)->where('type', '=', $type)->orderBy('post_datetime', 'DESC')->get();

        else
            return Avaibility::where('userid', '=', $userid)->orderBy('post_datetime', 'DESC')->get();

    }

    function searchAvailableDoctors(Request $request)
    {
        $fromDate = $request->get('fromdate');
        $toDate = $request->get('todate');
        $place = $request->get('place');
        $placelat = $request->get('placelat');
        $placelon = $request->get('placelon');
        $degree = $request->get('degree');
        $userid = $request->get('userid');
        $type = $request->get('type');
        $availabilities = Avaibility::where('available', '=', '1')->where('type', '=', $type)->get();
        $available_users = array();
        foreach ($availabilities as $availability) {
            $userid = $availability->userid;
            $user = User::find($userid);
            array_push($available_users, $user);
        }

        return $available_users;
    }

}
