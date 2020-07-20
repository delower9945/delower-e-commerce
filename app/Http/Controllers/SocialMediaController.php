<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SocialMedia;
use Carbon\Carbon;

class SocialMediaController extends Controller
{
    public function index(){
      return view('admin.socialMedia.index',[
        'social_medias' => SocialMedia::all()
      ]);
    }

    public function create(){
      return view('admin.socialMedia.add_socialMedia');
    }

    public function store(Request $request){
      $request->validate([
        'icon_name' => 'required',
        'social_media_link' => 'required',
      ]);

      SocialMedia::insert([
        'icon_name' => $request->icon_name,
        'social_media_link' => $request->social_media_link,
        'created_at' => Carbon::now()
      ]);
      return redirect('social/media')->with('message','Social Added Successfully...');
    }

    public function edit($id){
      return view('admin.socialMedia.edit',[
        'item' => SocialMedia::find($id)
      ]);
    }

    public function updateMedia(Request $request){
      SocialMedia::find($request->id)->update([
        'icon_name' => $request->icon_name,
        'social_media_link' => $request->social_media_link,
        'updated_at' => Carbon::now()
      ]);

      return redirect('social/media')->with('message','Social Updated Successfully...');
    }

    public function delete($id){
      SocialMedia::find($id)->delete();
      return back()->with('message','Social Delete Successfully...');
    }
}
