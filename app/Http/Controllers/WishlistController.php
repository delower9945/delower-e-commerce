<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wishlist;
use Carbon\Carbon;

class WishlistController extends Controller
{
  /*
    *specific product add to wish and remove wish
   */
    public function addToWish($product_id){
      if (Wishlist::where('product_id',$product_id)->where('ip_address',request()->ip())->exists()) {
        Wishlist::where('product_id',$product_id)->where('ip_address',request()->ip())->delete();
      }else {
        Wishlist::insert([
          'product_id' => $product_id,
          'wishlist' => 1,
          'ip_address' => request()->ip(),
          'created_at' => Carbon::now(),
        ]);
      }

      return back();
    }

    /*
    * Show the all of Wish list
    */
    public function WishlistShow(){
      return view('wishlist');
    }
}
