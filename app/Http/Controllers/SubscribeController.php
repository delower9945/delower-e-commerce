<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscribe;
use Auth;

class SubscribeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      return view('admin.subscribe.index',[
        'subscribes' => Subscribe::all()
      ]);
    }

    public function delete($id){
      Subscribe::find($id)->delete();
      return back()->with('message','Subscriber Deleted Sucessfully..');
    }
}
