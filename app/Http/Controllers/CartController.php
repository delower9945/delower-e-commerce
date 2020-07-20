<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Product;
use App\Cupon;
use Carbon\Carbon;

class CartController extends Controller
{
    /*
    * Add a Specific product in Cart
    */
    public function addToCart(Request $request){
      if (Cart::where('product_id',$request->product_id)->where('ip_address',request()->ip())->exists()) {
        Cart::where('product_id',$request->product_id)->where('ip_address',request()->ip())->increment('quantity',$request->quantity);
      }
      else {
        if (Product::find($request->product_id)->product_quantity < $request->quantity) {
          return back()->with('card_err',"You can't Add more than available product quantity");
        }
        else {
          Cart::insert([
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'ip_address' => request()->ip(),
            'created_at' => Carbon::now()
          ]);
        }

      }

      return back();
    }

    public function showCart($cupon_name = ''){
      if($cupon_name){
        if(Cupon::where('cupon_name',$cupon_name)->exists()){
          if (Cupon::where('cupon_name',$cupon_name)->first()->validity_till >= Carbon::now()->format('Y-m-d')) {
            return view('cart',[
              'cart_products' => Cart::where('ip_address',request()->ip())->get(),
              'discount_amount' => Cupon::where('cupon_name',$cupon_name)->first()->discount_amount,
              'cupon_name' => $cupon_name,
            ]);
          }
          else {
            return redirect('cart')->with('cupon_message',"This Cupon validity already exists.");
          }
        }
        else {
          return redirect('cart')->with('cupon_message',"This Cupon is not available.");
        }
      }
      else {
        return view('cart',[
          'cart_products' => Cart::where('ip_address',request()->ip())->get(),
        ]);
      }

    }

    public function addCartById($id){
      if (Cart::where('product_id',$id)->where('ip_address',request()->ip())->exists()) {
        Cart::where('product_id',$id)->where('ip_address',request()->ip())->increment('quantity',1);
      }
      else {
        Cart::insert([
          'product_id' => $id,
          'quantity' => 1,
          'ip_address' => request()->ip(),
          'created_at' => Carbon::now()
        ]);
      }

      return back();
    }

    /*
    * Remove the Specific Cart Item
    */
    public function removeCart($id){
      Cart::find($id)->delete();
      return back();
    }

    /*
    * Update the cart Quantity from storeg
    */
    public function updateCart(Request $request){
      // print_r($request->all());
      foreach($request->quantity as $cart_id => $total_quantity){
        Cart::find($cart_id)->update([
          'quantity' => $total_quantity,
          'updated_at' => Carbon::now()
        ]);
      }
      return back();
    }

}
