<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Logo;
use Carbon\Carbon;
use Image;

class LogoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index(){
      return view('admin.logo.index',[
        'logo' => Logo::find(1),
      ]);
    }

    public function edit($id){
      return view('admin.logo.index',[
        'picture' => Logo::find(1)->picture,
        'logo' => Logo::find(1),
      ]);
    }

    public function update(Request $request){
      // echo Carbon::now();
      // die();
      $request->validate([
        'picture' => 'required|mimes:png'
      ],[
        'picture.required' => "If you Want To updated you can't Empty This File."
      ]);
      $delete_location = base_path('public/uploads/logo/'."1.png");
      unlink($delete_location);

      $picture_upload = $request->file('picture');
      $name = "1"."."."png";
      $upload_location = base_path('public/uploads/logo/'.$name);
      Image::make($picture_upload)->resize(125,35)->save($upload_location);
      $id = 1;
      Logo::find($id)->update([
        'picture' => $name,
        'updated_at' => Carbon::now()
      ]);
      return redirect('logo')->with('logo_message','Logo Updated Successfully..');
    }
}
