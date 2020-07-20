<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Product;
use App\Cart;
use App\Order_list;
use Carbon\Carbon;
use Auth;
use Session;
use Stripe;


class StripePaymentController extends Controller
{
  /**
   * success response method.
   *
   * @return \Illuminate\Http\Response
   */
  public function stripe()

  {
      return view('stripe');
  }

  /**
   * success response method.
   *
   * @return \Illuminate\Http\Response
   */
  public function stripePost(Request $request)
  {
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      Stripe\Charge::create ([
              "amount" => $request->total * 100,
              "currency" => "usd",
              "source" => $request->stripeToken,
              "description" => "payment form Dragon."
      ]);


      // Insert Data From Order Table
      $order_id = Order::insertGetId([
        'user_id' => Auth::id(),
        'full_name' => $request->full_name,
        'email' =>$request->email,
        'phone' => $request->phone,
        'country' => $request->country,
        'address' => $request->address,
        'post_code' => $request->post_code,
        'city' => $request->city,
        'notes' => $request->notes,
        'payment_option' => $request->payment_option,
        'sub_total' => $request->sub_total,
        'total' => $request->total,
        'created_at' => Carbon::now()
      ]);

      foreach (Cart::where('ip_address',request()->ip())->get() as $cart) {
        //Insert Data From Order_list
        Order_list::insert([
          'order_id' => $order_id,
          'user_id' => Auth::id(),
          'product_id' => $cart->product_id,
          'quantity' => $cart->quantity,
          'created_at' => Carbon::now()
        ]);
        // Decrement Quantity from Product
        Product::find($cart->product_id)->decrement('product_quantity',$cart->quantity);
        // Delete Data form cart
        Cart::find($cart->id)->delete();
      }

      return redirect('/');

      // Session::flash('success', 'Payment successful!');
      // return back();
  }
}
