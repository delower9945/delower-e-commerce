<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product_multiple_picture;
use App\Slider;
use App\Testimonial;
use App\Product;
use App\Blog;
use App\Comment;
use App\SocialMedia;
use App\Subscribe;
use App\Review;
use App\Faq;
use Carbon\Carbon;

class FrontendController extends Controller
{
    public function index(){
      return view('index',[
        'categories' => Category::all(),
        'sliders' => Slider::all(),
        'testimonials' => Testimonial::all(),
        'products' => Product::all(),
      ]);
    }

    public function about(){
      return view('about');
    }

    public function shop(){
      return view('shop',[
        'categories' => Category::all(),
        'products' => Product::all(),
      ]);
    }

    public function categoryProduct($category_id){
      return view('category_prodcut',[
        'category_wise_product' => Product::where('category_id',$category_id)->get(),
      ]);
    }

    public function blog(){
      return view('blog',[
        'posts' => Blog::latest()->paginate(6),
      ]);
    }

    public function blogPost($post_id){
      return view('blog_details',[
        'post' => Blog::find($post_id),
        'categories' => Category::all(),
        'recent_posts' => Blog::where('id','!=',$post_id)->latest()->limit(4)->get(),
        'comments' => Comment::with('user')->where('blog_id',$post_id)->get(),
        'comment_total' => Comment::where('blog_id',$post_id)->count(),
        'social_icons' => SocialMedia::all()
      ]);
    }

    public function faq(){
      return view('faq',[
        'faqs' => Faq::all()
      ]);
    }

    public function productDescription($id){
      $category_id = Product::find($id)->category_id;
      return view('product_details',[
        'product' => Product::find($id),
        'multiple_pictures' => Product_multiple_picture::where('product_id',$id)->get(),
        'related_products' => Product::where('category_id', $category_id)->where('id', '!=', $id)->get(),
        'social_icons' => SocialMedia::all(),
        'reviews' => Review::where('product_id',$id)->get(),
        'total_review' => Review::where('product_id',$id)->count()
      ]);
    }

    /*
    * Show The Spcifique product item in ajax
    */
    public function showProduct($id){
      // echo $id;
      $product = Product::find($id);
      $category_name = $product->relationToCategory->category_name;
      return response()->json([
        'data' => $product,
        'category_name' => $category_name,
      ]);
    }

    /*
    * Insert Subscriber
    */
    public function subscrive(Request $request){
      $request->validate([
        'email' => 'required|email|unique:subscribes,email'
      ]);

      Subscribe::insert([
        'email' => $request->email,
        'created_at' => Carbon::now()
      ]);
      return redirect('/');
    }
}
