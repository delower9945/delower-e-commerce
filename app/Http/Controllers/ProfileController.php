<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index(){
      return view('admin.profile.index');
    }

    public function profileUpdate(Request $request){
      $request->validate([
        'name' => 'required'
      ]);

      User::find(Auth::id())->update([
        'name' => $request->name
      ]);
      return back()->with('profile_update',"Your Name Updated Successfully");
    }

    public function changePassword(Request $request){
      $request->validate([
        'old_password' => 'required',
        'password' => 'required|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/|confirmed',
        'password_confirmation' => 'required'
      ]);
      if ($request->old_password == $request->password) {
        return back()->withErrors('Your old password can not be same your new password' );
      }
      $old_password_form_user = $request->old_password;
      $old_password_form_db = Auth::user()->password;
      if(Hash::check($old_password_form_user,$old_password_form_db)){
        User::find(Auth::id())->update([
          'password' => Hash::make($request->password)
        ]);
        return back()->with('change_password_message','Password Change Successfully..');
      }
      else {
        return back()->withErrors('Your old password not match in db password');
      }

    }
}
