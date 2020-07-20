<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Testimonial;
use Carbon\Carbon;
use Image;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
      return view('admin.testimonial.index');
    }

    function show(){
      return view('admin.testimonial.testimonial_list',[
        'testimonials' => Testimonial::latest()->get(),
        'delete_testimonials' => Testimonial::onlyTrashed()->get(),
      ]);
    }

    function store(Request $request){
      $request->validate([
          'client_name' => 'required',
          'client_working_position' => 'required',
          'client_picture' => 'required|mimes:jpg,jpeg,png',
          'client_description' => 'required',
      ]);

      $insert_id = Testimonial::insertGetId([
        'client_name' => $request->client_name,
        'client_working_position' => $request->client_working_position,
        'client_description' => $request->client_description,
        'created_at' => Carbon::now(),
      ]);

      //Picture uploads Code here
      $file_name = $request->file('client_picture');
      $new_name = $insert_id.".".$file_name->getClientOriginalExtension();
      $upload_location = base_path('public/uploads/testimonial_images/'.$new_name);
      Image::make($file_name)->resize(135,105)->save($upload_location);
      Testimonial::find($insert_id)->update([
        'client_picture' => $new_name,
      ]);

      return redirect('testimonial/list')->with('testimonial_message',"Testimonial Added Successfully...");
    }

    function testimonialShow($id){
      return view('admin.testimonial.testimonial_show',[
        'testimonial' => Testimonial::find($id),
      ]);
    }

    function edit($id){
      return view('admin.testimonial.update_testimonial',[
        'testimonial' => Testimonial::find($id),
      ]);
    }

    function update(Request $request){
      if($request->hasFile('client_new_picture')){
        $delete_location = base_path('public/uploads/testimonial_images/'.Testimonial::find($request->id)->client_picture);
        unlink($delete_location);
        //Picture uploads Code here
        $file_name = $request->file('client_new_picture');
        $new_name = $request->id.".".$file_name->getClientOriginalExtension();
        $upload_location = base_path('public/uploads/testimonial_images/'.$new_name);
        Image::make($file_name)->resize(135,105)->save($upload_location);
        Testimonial::find($request->id)->update([
          'client_picture' => $new_name,
        ]);
      }
      Testimonial::find($request->id)->update([
        'client_name' => $request->client_name,
        'client_working_position' => $request->client_working_position,
        'client_description' => $request->client_description,
        'updated_at' => Carbon::now(),
      ]);

      return redirect('testimonial/list')->with('testimonial_message',"Testimonial Updated Successfully..");
    }

    function delete($id){
      Testimonial::find($id)->delete();
      return back()->with('testimonial_delete_message',"Testimonial Trashed Successfully..");
    }

    function restore($id){
      Testimonial::withTrashed()->find($id)->restore();
      return back()->with('testimonial_message',"Testimonial Restore Successfully..");
    }

    function heardDelete($id){
      $delete_location = base_path('public/uploads/testimonial_images/'.Testimonial::onlyTrashed()->find($id)->client_picture);
      unlink($delete_location);
      Testimonial::onlyTrashed()->find($id)->forceDelete();
      return back()->with('testimonial_message',"Testimonial Trashed Deleted Successfully..");
    }
}
