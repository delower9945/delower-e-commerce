<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use Auth;

class CheckoutController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }
    /*
    * To show the checkout page
    * if customer login
    */
    public function index(Request $request){
      if (Auth::user()->role == 1) {
        return redirect('cart')->with('cart_message',"Your are Admin You can't buye");
      }
      else {
        return view('checkout',[
          'carts' => Cart::where('ip_address',request()->ip())->get(),
          'total' => $request->total,
        ]);
      }
    }
}
