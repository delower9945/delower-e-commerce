<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Auth;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){
      $categories = Category::all();
      $delete_categories = Category::onlyTrashed()->get();
      return view('admin.category.index',compact('categories','delete_categories'));
    }

    public function addCategory(){
      return view('admin.category.add_category');
    }

    // Category Insert function here
    public function addCategory_Post(Request $request){
      //validation here
      $request->validate([
        'category_name' => 'required|unique:categories,category_name',
        'category_picture' => 'required|mimes:jpg,jpeg,png',
      ],[
        'category_name.required' => 'ক্যাটাগরি দাউ !',
        'category_name.unique' => 'You can not use this category name..'
      ]);

      $insert_id = Category::insertGetId([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id,
        'created_at' => Carbon::now()
      ]);

      $picture_uploads = $request->file('category_picture');
      $new_name = $insert_id.".".$picture_uploads->getClientOriginalExtension();
      $new_upload_location = base_path('public/uploads/category_images/'.$new_name);
      Image::make($picture_uploads)->resize(600,470)->save($new_upload_location);

      //picture insert in database
      Category::find($insert_id)->update([
        'category_picture' => $new_name
      ]);

      return back()->with('success_message','Category Insert Successfully.');
    }

    public function updateCategory($id){
      $category = Category::find($id);
      return view('admin.category.update_category',compact('category'));
    }

    // Category Update function here
    public function updateCategory_post(Request $request){
      $request->validate([
        'category_new_picture' => 'mimes:jpeg,jpg,png,PNG,JPEG,JPG',
      ]);

      if($request->hasFile('category_new_picture')){
        $delete_file_location = base_path('public/uploads/category_images/'.Category::find($request->id)->category_picture);
        unlink($delete_file_location);

        $new_picture_uploads = $request->file('category_new_picture');
        $new_name = $request->id.".".$new_picture_uploads->getClientOriginalExtension();
        $new_upload_location = base_path('public/uploads/category_images/'.$new_name);
        Image::make($new_picture_uploads)->resize(600,470)->save($new_upload_location);
        Category::find($request->id)->update([
          'category_picture' => $new_name
        ]);
      }

      Category::find($request->id)->update([
        'category_name' => $request->category_name,
        'updated_at' => Carbon::now()
      ]);
      return redirect('add/category')->with('update_success',"Category Updated Successfully");

    }

    // Category Soft delete function here
    public function deleteCategory($id){
      Category::find($id)->delete();
      return back()->with('delete_message','Category Deleted Successfully..');
    }

    //Category Restore function here
    public function restoreCategory($id){
      Category::withTrashed()->find($id)->restore();
      return back()->with('restore_message','Category Restore Successfully..');
    }

    //Category Heard Deletes function here
    public function heardDeleteCategory($id){
      $delete_file_location = base_path('public/uploads/category_images/'.Category::onlyTrashed()->find($id)->category_picture);
      unlink($delete_file_location);
      Category::onlyTrashed()->find($id)->forceDelete();
      return back()->with('hdelete_message','Category Heard Delete Successfully..');
    }
}
