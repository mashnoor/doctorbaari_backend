<?php

namespace App\Http\Controllers;

use App\PermanentJob;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PermanentjobController extends Controller
{
    function postPermanentJob(Request $request)
    {
        $post_date = Carbon::now()->toDateTimeString();

        $deadline = $request->get('deadline');
        $details = $request->get('details');
        $institute = $request->get('institute');
        $placename = $request->get('place');
        $degree = $request->get('degree');
        $placelat = $request->get('placelat');
        $placelon = $request->get('placelon');
        $userid = $request->get('userid');
        if($request->hasFile('imagefile'))
        {
            $path = Storage::putFileAs(
                'permanentimages', $request->file('avatar'), "1234.jpg"
            );
            return $path;
        }

        $user = User::find($userid);

        $permanentJob = new PermanentJob();
        $permanentJob->post_datetime = $post_date;

        $permanentJob->deadline = $deadline;
        $permanentJob->details = $details;
        $permanentJob->institute = $institute;
        $permanentJob->place = $placename;

        $permanentJob->available = 1;
        $permanentJob->placelat = $placelat;
        $permanentJob->placelon = $placelon;
        $permanentJob->degree = $degree;
        $permanentJob->userid = $userid;
        $permanentJob->username = $user->username;

        $permanentJob->save();

        return "success";


    }

    function distance($lat1, $lon1, $lat2, $lon2, $unit)
    {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }


    function cmp(PermanentJob $job_1, PermanentJob $job_2)
    {

    }

    function searchPermanentJob(Request $request)
    {
        $fromdate = $request->get('fromdate');
        $degree = $request->get('userid');
        $location = $request->get('place');
        $placelat = $request->get('placelat');
        $placelon = $request->get('placelon');

        //$jobs = PermanentJob::where('deadline', '>=', $startingDate)->where('degree', '=', $degree)->where('location', '=', $location)->get();
        return PermanentJob::all();
    }

    function getCollegeList()
    {
        $list = '["Abdul Malek Ukil Medical College", "Ad-Din Sakina Medical College", "Ad-din Women’s Medical College", "Anwer Khan Modern Medical College", "Armed Forced Medical College", "Army Medical College", "Army Medical College", "Army Medical College", "Army Medical College", "Army Medical College Bogra", "Ashiyan Medical College", "B.G.C Trust Medical College", "Bangladesh Medical College", "Barind Medical College", "Bikrampur Bhuiyans Medical College", "Brahmanbaria Medical College", "Central Medical College", "Chattagram Maa-O-Shishu Hospital Medical College", "Chittagong Medical College", "City Medical College", "Colonel Malek Medical College, Manikganj", "Comilla Medical College", "Community Based Medical College", "Cox\'s Bazar Medical College", "Delta Medical College", "Dhaka Central International Medical College", "Dhaka Community Medical College", "Dhaka Medical College", "Dhaka National Medical College", "Diabetic Association Medical College", "Dr. Sirajul Islam Medical College", "Eastern Medical College", "East-West Medical College", "Enam Medical College and Hospital", "Faridpur Medical College", "Gazi Medical College", "Gonoshasthaya Samaj Vittik Medical College", "Green Life Medical College", "Holy Family Red Crescent Medical College", "Ibn Sina Medical College", "Ibrahim Medical College", "Institute of Applied Health Sciences", "International Medical College", "Islami Bank Medical College", "Jahurul Islam Medical College", "Jalalabad Ragib-Rabeya Medical College", "Jessore Medical College", "Khulna Medical College", "Khwaja Yunus Ali Medical College", "Kumudini Women’s Medical College", "Kushtia Medical College", "M Abdur Rahim Medical College", "Mainamoti Medical College", "Marks Medical College", "Medical College for Women & Hospital", "MH Samorita Medical College", "Monno Medical College", "Mugda Medical College", "Mymensingh Medical College", "Nightingale Medical College", "North Bengal Medical College", "North East Medical College", "Northern International Medical College", "Northern Private Medical College", "Pabna Medical College", "Parkview Medical College", "Patuakhali Medical College", "Popular Medical College", "President Abdul Hamid Medical College", "Prime Medical College", "Rajshahi Medical College", "Rangamati Medical College", "Rangpur Community Medical College", "Rangpur Medical College", "Satkhira Medical College", "Shahabuddin Medical College", "Shaheed M. Monsur Ali Medical College", "Shaheed Monsur Ali Medical College", "Shaheed Suhrawardy Medical College", "Shaheed Tajuddin Ahmad Medical College", "Shaheed Ziaur Rahman Medical College", "Shahid Syed Nazrul Islam Medical College", "Sheikh Hasina Medical College", "Sheikh Sayera Khatun Medical College", "Sher-e-Bangla Medical College", "Sir Salimullah Medical College", "Southern Medical College", "Sylhet MAG Osmani Medical College", "Sylhet Women\'s Medical College", "T.M.S.S. Medical College", "Tairunnessa Memorial Medical College", "Universal Medical College", "US-Bangla Medical College", "Uttara Adhunik Medical College", "Z. H. Sikder Women\'s Medical College"]';
        //$list = '["Dhaka Medical College", "Sir Salimullah Medical College", "Shaheed Suhrawardy Medical College",  "Mymensingh Medical College", "Rajshahi Medical College", "Sylhet MAG Osmani Medical College", "Sher-e-Bangla Medical College", "Rangpur Medical College", "Comilla Medical College", "Khulna Medical College", "Shaheed Ziaur Rahman Medical College", "Faridpur Medical College" ,"M Abdur Rahim Medical College", "Pabna Medical College", "Abdul Malek Ukil Medical College", "Cox\'s Bazar Medical College", "Jessore Medical College", "Satkhira Medical College", "Shahid Syed Nazrul Islam Medical College", "Kushtia Medical College", "Sheikh Sayera Khatun Medical College", "Shaheed Tajuddin Ahmad Medical College", "Sheikh Hasina Medical College", "Colonel Malek Medical College,Manikganj", "Shaheed M. Monsur Ali Medical College", "Patuakhali Medical College", "Rangamati Medical College", "Mugda Medical College", "Armed Forced Medical College", "Army Medical College Bogra", "Army Medical College, Chittagong", "Army Medical College, Comilla", "Army Medical College, Jessore", "Army Medical College, Rangpur", "Ibrahim Medical College", "Bangladesh Medical College", "Holy Family Red Crescent Medical College", "Jahurul Islam Medical College", "Dhaka National Medical College", "Uttara Adhunik Medical College", "Shaheed Monsur Ali Medical College, Uttara, Dhaka", "Enam Medical College and Hospital", "Community Based Medical College", "Ibn Sina Medical College", "Shahabuddin Medical College", "Medical College for Women & Hospital", "Z. H. Sikder Women\'s Medical College", "Kumudini Women’s Medical College", "Tairunnessa Memorial Medical College", "East-West Medical College", "International Medical College", "Central Medical College", "B.G.C Trust Medical College", "Eastern Medical College", "Islami Bank Medical College", "Khwaja Yunus Ali Medical College", "Jalalabad Ragib-Rabeya Medical College", "Nightingale Medical College", "North East Medical College", "Institute of Applied Health Sciences", "Gonoshasthaya Samaj Vittik Medical College", "Chattagram Maa-O-Shishu Hospital Medical College", "T.M.S.S. Medical College", "Prime Medical College", "North Bengal Medical College", "Rangpur Community Medical College", "Delta Medical College", "Southern Medical College", "Anwer Khan Modern Medical College", "Ad-din Women’s Medical College", "Popular Medical College", "Green Life Medical College", "Dhaka Community Medical College", "Northern Private Medical College", "Sylhet Women\'s Medical College", "Monno Medical College", "MH Samorita Medical College", "City Medical College", "Marks Medical College", "Diabetic Association Medical College, Faridpur", "Barind Medical College", "Gazi Medical College", "Northern International Medical College", "Dhaka Central International Medical College", "Dr. Sirajul Islam Medical College", "Mainamoti Medical College", "Ad-Din Sakina Medical College", "Bikrampur Bhuiyans Medical College", "Universal Medical College", "Ashiyan Medical College", "US-Bangla Medical College", "President Abdul Hamid Medical College", "Brahmanbaria Medical College", "Parkview Medical College"]';

        return $list;
    }
}
