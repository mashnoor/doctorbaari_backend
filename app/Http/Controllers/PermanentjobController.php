<?php

namespace App\Http\Controllers;

use App\PermanentJob;
use App\User;
use Illuminate\Http\Request;

class PermanentjobController extends Controller
{
    function postPermanentJob(Request $request)
    {
        $post_date = date("Y-m-d");

        $deadline = $request->get('deadline');
        $details = $request->get('details');
        $hospital = $request->get('hospital');
        $placename = $request->get('placename');
        $degree = $request->get('degree');
        $placelat = $request->get('placelat');
        $placelon = $request->get('placelon');
        $userid = $request->get('userid');

        $user = User::find($userid);

        $permanentJob = new PermanentJob();
        $permanentJob->post_date = $post_date;
        $permanentJob->username = "null";
        $permanentJob->deadline = $deadline;
        $permanentJob->details = $details;
        $permanentJob->hospital = $hospital;
        $permanentJob->placename = $placename;

        $permanentJob->available = 1;
        $permanentJob->placelat = $placelat;
        $permanentJob->placelon = $placelon;
        $permanentJob->degree = $degree;
        $permanentJob->userid = $userid;
        $permanentJob->username = $user->fullname;

        $permanentJob->save();

        return "success";


    }

    function searchPermanentJob(Request $request)
    {
        $startingDate = $request->get('startingdate');
        $degree = $request->get('degree');
        $location = $request->get('location');

        $jobs = PermanentJob::where('deadline', '>=', $startingDate)->where('degree', '=', $degree)->where('location', '=', $location)->get();
        return $jobs;
    }
    function getCollegeList()
    {
        $list = '["Dhaka Medical College", "Sir Salimullah Medical College", "Shaheed Suhrawardy Medical College",  "Mymensingh Medical College", "Rajshahi Medical College", "Sylhet MAG Osmani Medical College", "Sher-e-Bangla Medical College", "Rangpur Medical College", "Comilla Medical College", "Khulna Medical College", "Shaheed Ziaur Rahman Medical College", "Faridpur Medical College" ,"M Abdur Rahim Medical College", "Pabna Medical College", "Abdul Malek Ukil Medical College", "Cox\'s Bazar Medical College", "Jessore Medical College", "Satkhira Medical College", "Shahid Syed Nazrul Islam Medical College", "Kushtia Medical College", "Sheikh Sayera Khatun Medical College", "Shaheed Tajuddin Ahmad Medical College", "Sheikh Hasina Medical College", "Colonel Malek Medical College,Manikganj", "Shaheed M. Monsur Ali Medical College", "Patuakhali Medical College", "Rangamati Medical College", "Mugda Medical College", "Armed Forced Medical College", "Army Medical College Bogra", "Army Medical College, Chittagong", "Army Medical College, Comilla", "Army Medical College, Jessore", "Army Medical College, Rangpur", "Ibrahim Medical College", "Bangladesh Medical College", "Holy Family Red Crescent Medical College", "Jahurul Islam Medical College", "Dhaka National Medical College", "Uttara Adhunik Medical College", "Shaheed Monsur Ali Medical College, Uttara, Dhaka", "Enam Medical College and Hospital", "Community Based Medical College", "Ibn Sina Medical College", "Shahabuddin Medical College", "Medical College for Women & Hospital", "Z. H. Sikder Women\'s Medical College", "Kumudini Women’s Medical College", "Tairunnessa Memorial Medical College", "East-West Medical College", "International Medical College", "Central Medical College", "B.G.C Trust Medical College", "Eastern Medical College", "Islami Bank Medical College", "Khwaja Yunus Ali Medical College", "Jalalabad Ragib-Rabeya Medical College", "Nightingale Medical College", "North East Medical College", "Institute of Applied Health Sciences", "Gonoshasthaya Samaj Vittik Medical College", "Chattagram Maa-O-Shishu Hospital Medical College", "T.M.S.S. Medical College", "Prime Medical College", "North Bengal Medical College", "Rangpur Community Medical College", "Delta Medical College", "Southern Medical College", "Anwer Khan Modern Medical College", "Ad-din Women’s Medical College", "Popular Medical College", "Green Life Medical College", "Dhaka Community Medical College", "Northern Private Medical College", "Sylhet Women\'s Medical College", "Monno Medical College", "MH Samorita Medical College", "City Medical College", "Marks Medical College", "Diabetic Association Medical College, Faridpur", "Barind Medical College", "Gazi Medical College", "Northern International Medical College", "Dhaka Central International Medical College", "Dr. Sirajul Islam Medical College", "Mainamoti Medical College", "Ad-Din Sakina Medical College", "Bikrampur Bhuiyans Medical College", "Universal Medical College", "Ashiyan Medical College", "US-Bangla Medical College", "President Abdul Hamid Medical College", "Brahmanbaria Medical College", "Parkview Medical College"]';
        return $list;
    }
}
