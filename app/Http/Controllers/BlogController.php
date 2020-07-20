<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Blog;
use Carbon\Carbon;
use Image;

class BlogController extends Controller
{
  /**
   * Display a listing of the Blog Post
   */
    public function index(){
      return view('admin.blog.index',[
        'posts' => Blog::latest()->get(),
        'delete_posts' => Blog::onlyTrashed()->get(),
      ]);
    }

    /**
     * Show the form for creating a new Blog Post.
     */
    public function create(){
      return view('admin.blog.add_blog');
    }

    /**
     * Store a newly created Blog post in storage.
     */
    public function store(Request $request){
      $request->validate([
        'post_title' => 'required',
        'post_picture' => 'required|mimes:jpg,jpeg,png',
        'post_description' => 'required',
      ]);

      $post_id = Blog::insertGetId([
        'post_title' => $request->post_title,
        'user_id' => Auth::id(),
        'post_description' => $request->post_description,
        'created_at' => Carbon::now(),
      ]);

      //Picture Insert Code
      $file_name = $request->file('post_picture');
      $new_name = $post_id.".".$file_name->getClientOriginalExtension();
      $upload_location = base_path('public/uploads/blog_images/'.$new_name);
      Image::make($file_name)->resize(870,500)->save($upload_location);

      Blog::find($post_id)->update([
        'post_picture' => $new_name,
      ]);

      return redirect('blog/list')->with('blog_success',"Post Added Successfully");

    }

    /**
     * Display the specified BlogPost.
     */
     public function show($id){
       return view('admin.blog.post_show',[
         'post' => Blog::find($id),
       ]);
     }

     /**
      * Show the form for editing the specified Blog Post.
      */
      public function edit($id){
        return view('admin.blog.edit_post',[
          'post' => Blog::find($id),
        ]);
      }

      /**
       * Update the specified Blog Post in storage.
       */
       public function update(Request $request){
         $request->validate([
           'post_title' => 'required',
           'post_picture' => 'mimes:jpg,jpeg,png',
           'post_description' => 'required',
         ]);

         if ($request->hasFile('post_new_picture')) {
           $delete_location = base_path('public/uploads/blog_images/'.Blog::find($request->id)->post_picture);
           unlink($delete_location);

           //Picture Update Code
           $file_name = $request->file('post_new_picture');
           $new_name = $request->id.".".$file_name->getClientOriginalExtension();
           $upload_location = base_path('public/uploads/blog_images/'.$new_name);
           Image::make($file_name)->resize(870,500)->save($upload_location);

           Blog::find($request->id)->update([
             'post_picture' => $new_name,
             'updated_at' => Carbon::now(),
           ]);
         }

         Blog::find($request->id)->update([
           'post_title' => $request->post_title,
           'post_description' => $request->post_description,
           'updated_at' => Carbon::now(),
         ]);
         return redirect('blog/list')->with('blog_success',"Post Updatede Successfully");
       }

       /**
        * Trashed the specified Blog Post from storage.
        */
        public function delete($id){
          Blog::find($id)->delete();
          return redirect('blog/list')->with('blog_message_success',"Post Trashed Successfully");
        }

        /**
         * Restore the specified Blog Post from storage.
         */
         public function restore($id){
           Blog::withTrashed()->find($id)->restore();
           return redirect('blog/list')->with('blog_success',"Post Restore Successfully");
         }

         /**
          * Trashed the specified Blog Post from storage.
          */
        public function heardDelete($id){
          $delete_location = base_path('public/uploads/blog_images/'.Blog::onlyTrashed()->find($id)->post_picture);
          unlink($delete_location);

          Blog::onlyTrashed()->find($id)->forceDelete();
          return redirect('blog/list')->with('blog_success',"Post Deleted Successfully");
        }
}
