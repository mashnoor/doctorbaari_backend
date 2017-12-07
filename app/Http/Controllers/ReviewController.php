<?php

namespace App\Http\Controllers;

use App\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    function makeReview(Request $request)
    {
        $reviewed_from = $request->get('reviewed_from');
        $reviewed_to = $request->get('reviewed_to');
        $review = $request->get('review');
        $rating = $request->get('rating');
        $datetime = Carbon::now()->toDateTimeString();

        $newrev = new Review();
        $newrev->reviewed_from = $reviewed_from;
        $newrev->reviewed_to = $reviewed_to;
        $newrev->review = $review;
        $newrev->rating = $rating;
        $newrev->post_datetime = $datetime;

        $newrev->save();
        return "success";
    }
    function getReviews(Request $request)
    {
        $reviewed_to = $request->get('reviewed_to');
        $reviews = Review::where('reviewed_to', '=', $reviewed_to)->get();
        return $reviews;
    }
}
