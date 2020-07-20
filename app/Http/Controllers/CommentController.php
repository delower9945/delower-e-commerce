<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use Carbon\Carbon;
use Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
      $request->validate([
        'description' => 'required',
      ]);
      if (Auth::user()->role == 2) {
        Comment::insert([
          'user_id' => Auth::id(),
          'blog_id' => $request->post_id,
          'description' => $request->description,
          'created_at' => Carbon::now()
        ]);
        return redirect('blog/post/'.$request->post_id);
      }
      else {
        return redirect('blog/post/'.$request->post_id)->with('comment_message',"You are Admin You Can't Comment");
      }
    }

}
