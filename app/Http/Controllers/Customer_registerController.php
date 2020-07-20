<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Hash;

class Customer_registerController extends Controller
{
    /*
    * Show the Customer Register page
    */
    public function customerRegister(){
      return view('customer_register');
    }

    /*
    * Register customer
    */
    public function customerRegisterPost(Request $request){
      $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed',
        'password_confirmation' => 'required'
      ]);
      User::insert([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => 2,
        'created_at' => Carbon::now()
      ]);
      return redirect('login')->with('login_message','Your Registraion Successfully');
    }
}
