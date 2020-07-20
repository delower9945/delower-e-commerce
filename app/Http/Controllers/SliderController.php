<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;
use Carbon\Carbon;
use Image;

class SliderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
  // Index function here
    public function index()
    {
      return view('admin.slider.index',[
        'sliders' => Slider::latest()->get(),
      ]);
    }

    //Slider add
    public function addSlider(){
      return view('admin.slider.add_slider');
    }

    // store function here
    public function store(Request $request){
      $this->validate($request,[
        'slider_title' => 'required',
        'slider_picture' => 'required|mimes:jpeg,jpg,png',
        'slider_description' => 'required',
      ]);

      $insert_id = Slider::insertGetId([
        'slider_title' => $request->slider_title,
        'slider_description' => $request->slider_description,
        'created_at' => Carbon::now(),
      ]);

      $new_picture_upload = $request->file('slider_picture');
      $new_name = $insert_id.".".$new_picture_upload->getClientOriginalExtension();
      $upload_location = base_path("public/uploads/slider_images/".$new_name);
      Image::make($new_picture_upload)->resize(1920,1000)->save($upload_location);

      Slider::find($insert_id)->update([
        'slider_picture' => $new_name
      ]);

      return redirect('slider/list')->with('slider_message','Slider Added Successfully..');
    }

    // Edit function here
    // this function show the data in edit field
    function edit($id){
      $slider = Slider::find($id);
      return view('admin.slider.update_slider',compact('slider'));
    }

    // update function here
    // update the edit data into database file
    function update(Request $request){
      $request->validate([
        'slider_title' => 'required',
        'slider_description' => 'required',
        'slider_new_picture' => 'mimes:jpg,jpeg,png',
      ]);

      if($request->hasFile('slider_new_picture')){
        $delete_location = base_path('public/uploads/slider_images/'.Slider::find($request->slider_id)->slider_picture);
        unlink($delete_location);

        $file_name = $request->file('slider_new_picture');
        $new_name = $request->slider_id.".".$file_name->getClientOriginalExtension();
        $upload_location = base_path('public/uploads/slider_images/'.$new_name);
        Image::make($file_name)->resize(1920,1000)->save($upload_location);
        Slider::find($request->slider_id)->update([
          'slider_picture' => $new_name
        ]);
      }

      Slider::find($request->slider_id)->update([
        'slider_title' => $request->slider_title,
        'slider_description' => $request->slider_description,
        'updated_at' => Carbon::now()
      ]);

      return redirect('slider/list')->with('slider_message','Slider Updated Successfully');
    }

    // slider Delete function here
    function delete($id){
      $delete_location = base_path('public/uploads/slider_images/'.Slider::find($id)->slider_picture);
      unlink($delete_location);
      Slider::find($id)->delete();
      return back()->with('slider_message','Slider Deleted Successfully');
    }
}
