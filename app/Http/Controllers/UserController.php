<?php

namespace App\Http\Controllers;

use App\Avaibility;

use App\Sub;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function signupMBBS(Request $request)
    {
        $name = $request->get('username');
        $medicalCollege = $request->get('medicalcollege');
        $regno = $request->get('regno');
        $contact = $request->get('contact');
        $degree = $request->get('degree');
        $dateofbirth = $request->get('dateofbirth');
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
        $user->birthdate = $dateofbirth;
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

        $avaibility = new Avaibility();
        $avaibility->from_date = $fromdate;
        $avaibility->to_date = $todate;
        $avaibility->place = $place;
        $avaibility->placelat = $placelat;
        $avaibility->placelon = $placelon;
        $avaibility->post_datetime = Carbon::now()->toDateTimeString();
        $avaibility->available = $available;
        $avaibility->userid = $userid;

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
        $subPosts = Sub::where('userid', '=', $userid)->orderBy('post_datetime', 'DESC')->get();

        return $subPosts;
        //$permanentPosts = PermanentJob::where('userid', '=', $userid)->get();

        //return array_merge($subPosts, $permanentPosts);
    }

    function getAvaibilityList(Request $request)
    {
        $userid = $request->get('userid');
        $list = Avaibility::where('userid', '=', $userid)->orderBy('post_datetime', 'DESC')->get();

        return $list;
    }

}
