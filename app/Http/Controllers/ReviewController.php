<?php

namespace App\Http\Controllers;

use App\Review;
use App\User;
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

        $prevReview = Review::where([
            ['reviewed_to' => $reviewed_to],
            ['reviewed_from' => $reviewed_from]
        ])->first();

        if ($prevReview != null) {
            return 'already';
        }

        $reviewer = User::find($reviewed_from);

        $newrev = new Review();
        $newrev->reviewed_from = $reviewed_from;
        $newrev->reviewed_to = $reviewed_to;
        $newrev->review = $review;
        $newrev->rating = $rating;
        $newrev->reviewer_name = $reviewer->username;
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
