<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
use Carbon\Carbon;

class ContactController extends Controller
{

  //Show the Contact page function here
    public function index(){
      return view('contact');
    }

    //Store The Contact function Here
    public function store(Request $request){
      $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'subject' => 'required',
        'message' => 'required',
      ]);

      Contact::insert([
        'name' => $request->name,
        'email' => $request->email,
        'subject' => $request->subject,
        'message' => $request->message,
        'status' => 1,
        'created_at' => Carbon::now()
      ]);
      return back()->with('conect_message','Thanks For Contact us..');
    }

    //Contact message show in dashboard
    // Show function Here
    public function show(){
      $messages = Contact::latest()->get();
      $trashed_messages = Contact::onlyTrashed()->get();
      return view('admin.contact.index',compact('messages','trashed_messages'));
    }

    public function messageView($id){
      $message = Contact::find($id);
      return view('admin.contact.view',compact('message'));
    }

    public function messageSeen($id){
      Contact::find($id)->update([
        'status' => 2
      ]);
      return back()->with('contact_message','Message Seen Successfully....');
    }

    public function messageUnseen($id){
      Contact::find($id)->update([
        'status' => 1
      ]);
      return back()->with('contact_message','Message Unseen Successfully....');
    }

    public function delete($id){
      Contact::find($id)->delete();
      return back()->with('contact_delete_message','Message Trashed Successfully....');
    }

    public function restore($id){
      Contact::withTrashed()->find($id)->restore();
      return back()->with('contact_message','Message Restore Successfully....');
    }

    public function heardDelete($id){
      Contact::onlyTrashed()->find($id)->forceDelete();
      return back()->with('contact_message','Message Trashed Delete Successfully....');
    }
}
