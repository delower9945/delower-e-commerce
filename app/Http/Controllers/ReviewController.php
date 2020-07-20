<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order_list;
use App\Product;
use App\Review;
use Carbon\Carbon;
use Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addReview(Request $request){
      if (Auth::user()->role == 1) {
        return back()->with('review_message',"You are a admin can't any review");
      }
      else {
        if (Order_list::where('product_id',$request->product_id)->where('user_id',Auth::id())->exists()) {
          $request->validate([
            'star' => 'required',
            'massage' => 'required'
          ]);
          Review::insert([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'star' => $request->star,
            'message' => $request->massage,
            'created_at' =>  Carbon::now()
          ]);
          return back();
        }
        else {
          return back()->with('review_message',"You can't review this product because you can't buy this product ....First buy this product then reviw this product");
        }
      }
    }
}
