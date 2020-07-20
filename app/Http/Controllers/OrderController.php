<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\Order_list;
use App\Product;
use App\Cart;
use Carbon\Carbon;
use Auth;

class OrderController extends Controller
{
    public function orderPost(Request $request){

      // $request->validate([
      //   'full_name' => 'required',
      //   'email' => 'required|email',
      //   'phone' => 'required',
      //   'country' => 'required',
      //   'address' => 'required',
      //   'post_code' => 'required',
      //   'city' => 'required',
      //   'notes' => 'required',
      //   'payment_option' => 'required',
      // ]);

      if($request->payment_option == 1){

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

      }
      else{
        return view('stripe',[
          'request_all_data' => $request->all(),
        ]);
        // return redirect('stripe')->with('total',$request->total);
      }



    }
}
