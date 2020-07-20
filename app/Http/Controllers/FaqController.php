<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Faq;
use Carbon\Carbon;
use Auth;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      return view('admin.faq.index',[
        'faqs' => Faq::all()
      ]);
    }

    public function create(){
      return view('admin.faq.add_faq');
    }

    public function store(Request $request){
      $request->validate([
        'question' => 'required',
        'answer' => 'required'
      ]);

      Faq::insert([
        'question' => $request->question,
        'answer' => $request->answer,
        'created_at' => Carbon::now()
      ]);

      return redirect('faq/list')->with('faq_message','FAQ Added Successfully');
    }

    public function edit($id){
      return view('admin.faq.edit',[
        'faq' => Faq::find($id)
      ]);
    }

    public function update(Request $request){
      $request->validate([
        'question' => 'required',
        'answer' => 'required'
      ]);

      Faq::find($request->id)->update([
        'question' => $request->question,
        'answer' => $request->answer,
        'updated_at' => Carbon::now()
      ]);

      return redirect('faq/list')->with('faq_message','FAQ Updated Successfully');
    }

    public function delete($id){
      Faq::find($id)->delete();
      return back()->with('faq_message','FAQ Deleted Successfully');
    }

}
