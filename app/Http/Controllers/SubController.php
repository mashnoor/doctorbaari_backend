<?php

namespace App\Http\Controllers;

use App\Avaibility;
use App\PermanentJob;
use App\Sub;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubController extends Controller
{

    function cmp(Sub $job_1, Sub $job_2)
    {
        if ($job_1->distance == $job_2->distance) return 0;
        if ($job_1->distance < $job_2->distance) return -1;
        return 1;

    }

    function searchSubJobs(Request $request)
    {
        $placeLat = doubleval($request->get('placelat'));
        $placeLon = doubleval($request->get('placelon'));
        $fromdate = $request->get('fromdate');
        $todate = $request->get('todate');
        //$subs = Sub::with('user')->where('date_from', '>=', $fromdate)->where('date_to', '<=', $todate)->where('available', '1')->get();
        $subsFrom = Sub::with('user')->where('date_from', '>=', $fromdate)->where('date_from', '<=', $todate)->where('available', '1')->get();
        $subsTo = Sub::with('user')->where('date_to', '>=', $fromdate)->where('date_to', '<=', $todate)->where('available', '1')->get();

        $merged = $subsTo->merge($subsFrom);

        $subs = $merged->all();
        $retSubs = array();

        foreach ($subs as $cursub) {
            $clat = doubleval($cursub->placelat);
            $clon = doubleval($cursub->placelon);
            $cursub->distance = HelperController::distance($placeLat, $placeLon, $clat, $clon, "K");
            array_push($retSubs, $cursub);
        }
        usort($retSubs, array($this, "cmp"));

        return $retSubs;
    }

    function postSub(Request $request)
    {


        $date_to = $request->get('date_to');
        $date_from = $request->get('date_from');
        $place = $request->get('place');
        $placelat = $request->get('placelat');
        $placelon = $request->get('placelon');
        $institute = $request->get('institute');
        $details = $request->get('details');
        $userid = $request->get('userid');
        $degree = $request->get('degree');

        $user = User::find($userid);


        $sub = new Sub();
        $sub->post_datetime = Carbon::now()->toDateTimeString();
        $sub->date_to = $date_to;
        $sub->date_from = $date_from;
        $sub->place = $place;
        $sub->username = $user->username;
        $sub->userid = $userid;
        $sub->placelat = $placelat;
        $sub->placelon = $placelon;
        $sub->duration = strtotime($date_to) - strtotime($date_from);
        $sub->institute = $institute;
        $sub->details = $details;
        $sub->available = 1;
        $sub->degree = $degree;

        $sub->save();

        return "success";


    }


    function getNewsFeed(Request $request)
    {
        $todayDate = date("Y-m-d");

        $userid = $request->get('userid');
        $user = User::find($userid);
        $lat = doubleval($user->placelat);
        $lon = doubleval($user->placelon);

        $subs = Sub::orderBy('post_datetime', 'DESC')->where('date_to', '>=', $todayDate)->where('available', '1')->get();
        $permanents = PermanentJob::orderBy('post_datetime', 'DESC')->where('deadline', '>=', $todayDate)->where('available', '1')->get();

        $main_res = array();

        $len_sub = count($subs);
        $len_per = count($permanents);
        $i = 0;
        $j = 0;
        while ($i < $len_sub && $j < $len_per) {
            if ($subs[$i]->post_datetime > $permanents[$j]->post_datetime) {
                $subs[$i]['user'] = User::find($subs[$i]->userid);
                $culat = doubleval($subs[$i]->placelat);
                $clon = doubleval($subs[$i]->placelon);
                $subs[$i]->distance = HelperController::distance($lat, $lon, $culat, $clon, "K");
                array_push($main_res, $subs[$i]);
                $i++;
            } else {
                $permanents[$j]['user'] = User::find($permanents[$j]->userid);
                $culat = doubleval($permanents[$j]->placelat);
                $clon = doubleval($permanents[$j]->placelon);
                $permanents[$j]->distance = HelperController::distance($lat, $lon, $culat, $clon, "K");
                array_push($main_res, $permanents[$j]);

                $j++;
            }
        }
        while ($i < $len_sub) {
            $subs[$i]['user'] = User::find($subs[$i]->userid);
            $culat = doubleval($subs[$i]->placelat);
            $clon = doubleval($subs[$i]->placelon);
            $subs[$i]->distance = HelperController::distance($lat, $lon, $culat, $clon, "K");
            array_push($main_res, $subs[$i]);
            $i++;
        }
        while (($j < $len_per)) {
            $permanents[$j]['user'] = User::find($permanents[$j]->userid);
            $culat = doubleval($permanents[$j]->placelat);
            $clon = doubleval($permanents[$j]->placelon);
            $permanents[$j]->distance = HelperController::distance($lat, $lon, $culat, $clon, "K");
            array_push($main_res, $permanents[$j]);
            $j++;
        }

        return $main_res;
    }


}
