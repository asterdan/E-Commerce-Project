<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Auth;

class ReviewController extends Controller
{
    //
    public function addReview(Request $request)
    {
        $body = $request->input('review');
        $product_id = $request->input('product_id');
        $user_id = Auth::user()->id;
        $review = new Review;
        $review->review = $body;
        $review->user_id = $user_id;
        $review->product_id = $product_id;
        $review->save();

        return response()->json(['message'=>'Review created successfully!']);
        
    }

    public function getReviews(Request $request)
    {
        $product_id = $request->input('product_id');
        $reviews = Review::where('product_id',$product_id)->get();
        
        return view('reviews.getReviews')->with('data',$reviews);
    }
}
