<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Product_multiple_picture;
use Carbon\Carbon;
use App\Category;
use App\Cart;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
      return view('admin.product.index',[
        'categories' => Category::all(),
      ]);
    }

    public function store(Request $request){
      $request->validate([
        'product_name' => 'required',
        'category_id' => 'required',
        'product_price' => 'required',
        'product_thumbnail_picture' => 'required|mimes:jpg,jpeg,png',
        'product_multiple_pictures' => 'required',
        'product_quantity' => 'required',
        'product_short_description' => 'required',
        'product_long_description' => 'required',
      ]);

      $insert_id = Product::insertGetId([
        'product_name' => $request->product_name,
        'category_id' =>  $request->category_id,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'product_short_description' => $request->product_short_description,
        'product_long_description' => $request->product_long_description,
        'created_at' => Carbon::now()
      ]);

      // picture insert code
      $file_name = $request->file('product_thumbnail_picture');
      $new_name = $insert_id.".".$file_name->getClientOriginalExtension();
      $upload_location = base_path('public/uploads/product_images/'.$new_name);
      Image::make($file_name)->resize(600,622)->save($upload_location);

      Product::find($insert_id)->update([
        'product_thumbnail_picture' => $new_name
      ]);

      // Multiple Images insert Code here
      $flag = 1;
      foreach($request->file('product_multiple_pictures') as $product_multiple_picture){
        // Multipule picture insert code
        $file_name = $product_multiple_picture;
        $new_name = $insert_id."-".$flag.".".$file_name->getClientOriginalExtension();
        echo $upload_location = base_path('public/uploads/product_multiple_images/'.$new_name);
        Image::make($file_name)->resize(600,550)->save($upload_location);
        Product_multiple_picture::insert([
          'product_id' => $insert_id,
          'picture_name' => $new_name,
          'created_at' => Carbon::now()
        ]);
        $flag++;
      }

      return redirect('product/list')->with('product_message','Product Added Successfully...');
    }

    public function show(){
      return view('admin.product.product_list',[
        'products' => Product::latest()->get(),
        'delete_products' => Product::onlyTrashed()->get(),
      ]);
    }

    public function productDetails($id){
      return view('admin.product.product_details',[
        'product' => Product::find($id),
      ]);
    }

    public function edit($id){
      return view('admin.product.product_edit',[
        'product' => Product::find($id),
        'categories' => Category::all(),
      ]);
    }

    public function update(Request $request){
      $request->validate([
        'product_name' => 'required',
        'category_id' => 'required',
        'product_price' => 'required',
        'product_new_thumbnail_picture' => 'mimes:jpg,jpeg,png',
        'product_quantity' => 'required',
        'product_short_description' => 'required',
        'product_long_description' => 'required',
      ]);

      if ($request->hasFile('product_new_thumbnail_picture')) {
        $delete_location = base_path('public/uploads/product_images/'.Product::find($request->id)->product_thumbnail_picture);
        unlink($delete_location);

        // picture update code
        $file_name = $request->file('product_new_thumbnail_picture');
        $new_name = $request->id.".".$file_name->getClientOriginalExtension();
        $upload_location = base_path('public/uploads/product_images/'.$new_name);
        Image::make($file_name)->resize(600,622)->save($upload_location);

        Product::find($request->id)->update([
          'product_thumbnail_picture' => $new_name
        ]);
      }

      Product::find($request->id)->update([
        'product_name' => $request->product_name,
        'category_id' =>  $request->category_id,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_quantity,
        'product_short_description' => $request->product_short_description,
        'product_long_description' => $request->product_long_description,
        'updated_at' => Carbon::now()
      ]);

      return redirect('product/list')->with('product_message','Product Updated Successfully...');

    }

    public function delete($id){
      Product::find($id)->delete();
      return back()->with('product_delete_message','Product Trashed Successfully...');
    }

    public function restore($id){
      Product::withTrashed()->find($id)->restore();
      return back()->with('product_message','Product Restore Successfully...');
    }

    public function heardDelete($id){
      
      $delete_location = base_path('public/uploads/product_images/'.Product::onlyTrashed()->find($id)->product_thumbnail_picture);
      unlink($delete_location);

      Product::onlyTrashed()->find($id)->forceDelete();
      return back()->with('product_message','Product Trashed Successfully...');
    }
}
