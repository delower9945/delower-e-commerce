<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//FrontendController
Route::get('/','FrontendController@index');
Route::get('about','FrontendController@about');
Route::get('single/product/description/{id}','FrontendController@productDescription');
Route::get('shop','FrontendController@shop');
Route::get('blog','FrontendController@blog');
Route::get('faq','FrontendController@faq');
Route::get('blog/post/{post_id}','FrontendController@blogPost');
Route::get('show/product/{id}','FrontendController@showProduct');
Route::get('category/product/{category_id}','FrontendController@categoryProduct');
Route::post('subscribe/post','FrontendController@subscrive');

//ContactController Routes
Route::get('/contact','ContactController@index');
Route::post('/contact/store','ContactController@store');
Route::get('contact/message/show','ContactController@show')->middleware('auth');
Route::get('contact/message/view/{id}','ContactController@messageView')->middleware('auth');
Route::get('contact/message/seen/{id}','ContactController@messageSeen')->middleware('auth');
Route::get('contact/message/unseen/{id}','ContactController@messageUnseen')->middleware('auth');
Route::get('contact/message/delete/{id}','ContactController@delete')->middleware('auth');
Route::get('contact/message/restore/{id}','ContactController@restore')->middleware('auth');
Route::get('contact/message/heard_delete/{id}','ContactController@heardDelete')->middleware('auth');

// Authentication Route
Auth::routes(['verify' => true]);

//HomeController Routes
Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

//LogoController Route
Route::get('logo','LogoController@index');
Route::get('logo/edit/{id}','LogoController@edit');
Route::post('logo/update','LogoController@update');

// CategoryController Routes
Route::get('category/list','CategoryController@index');
Route::get('add/category','CategoryController@addCategory');
Route::post('add/category/post','CategoryController@addCategory_Post');
Route::get('update/category/{id}','CategoryController@updateCategory');
Route::post('update/category/post','CategoryController@updateCategory_post');
Route::get('delete/category/{id}','CategoryController@deleteCategory');
Route::get('restore/category/{id}','CategoryController@restoreCategory');
Route::get('herddelete/category/{id}','CategoryController@heardDeleteCategory');

//SliderController Routes
Route::get('slider/list','SliderController@index');
Route::get('add/slider','SliderController@addSlider');
Route::post('add/slider/store','SliderController@store');
Route::get('slider/edit/{id}','SliderController@edit');
Route::post('slider/update','SliderController@update');
Route::get('slider/delete/{id}','SliderController@delete');

//ProfileController Routes
Route::get('profile','ProfileController@index');
Route::post('profile/update','ProfileController@profileUpdate');
Route::post('profile/change/password','ProfileController@changePassword');

// TestimonialController Routes
Route::get('add/testimonial','TestimonialController@index');
Route::get('testimonial/list','TestimonialController@show');
Route::post('add/testimonial/store','TestimonialController@store');
Route::get('testimonial/show/{id}','TestimonialController@testimonialShow');
Route::get('testimonial/edit/{id}','TestimonialController@edit');
Route::post('testimonial/update','TestimonialController@update');
Route::get('testimonial/delete/{id}','TestimonialController@delete');
Route::get('testimonial/restore/{id}','TestimonialController@restore');
Route::get('testimonial/heard/delete/{id}','TestimonialController@heardDelete');

// ProductController Routes
Route::get('add/product','ProductController@index');
Route::post('add/product/store','ProductController@store');
Route::get('product/list','ProductController@show');
Route::get('product/show/{id}','ProductController@productDetails');
Route::get('product/edit/{id}','ProductController@edit');
Route::post('product/update','ProductController@update');
Route::get('product/delete/{id}','ProductController@delete');
Route::get('product/restore/{id}','ProductController@restore');
Route::get('product/heard/delete/{id}','ProductController@heardDelete');

// BlogController Routes
Route::get('blog/list','BlogController@index');
Route::get('blog/add','BlogController@create');
Route::post('blog/add/store','BlogController@store');
Route::get('blog/post/show/{id}','BlogController@show');
Route::get('blog/post/edit/{id}','BlogController@edit');
Route::post('blog/post/update','BlogController@update');
Route::get('blog/post/delete/{id}','BlogController@delete');
Route::get('blog/post/restore/{id}','BlogController@restore');
Route::get('blog/post/heard/delete/{id}','BlogController@heardDelete');

//CommentController Routes
Route::post('add/comment','CommentController@store');

//CardController Routes
Route::post('add/to/cart','CartController@addToCart');
Route::get('cart','CartController@showCart');
Route::get('cart/{cupon_name}','CartController@showCart');
Route::get('add/cart/{id}','CartController@addCartById');
Route::get('remove/cart/{id}','CartController@removeCart');
Route::post('cart/update','CartController@updateCart');

// WishlistController Routes
Route::get('add/wish/{product_id}','WishlistController@addToWish');
Route::get('wishlist','WishlistController@WishlistShow');

//CuponController Routes
Route::get('cupon/add','CuponController@addCupon');
Route::post('cupon/add/post','CuponController@store');
Route::get('cupon/list','CuponController@index');
Route::get('cupon/edit/{id}','CuponController@edit');
Route::post('cupon/update','CuponController@update');
Route::get('cupon/delete/{id}','CuponController@delete');
Route::get('cupon/restore/{id}','CuponController@restore');
Route::get('cupon/heard/delete/{id}','CuponController@heardDelete');

//CheckoutController Routes
Route::post('checkout','CheckoutController@index');

//OrderController Route
Route::post('order/post','OrderController@orderPost');

//StripePaymentController Routes
Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

//Customer_registerController Routes
Route::get('customer/register','Customer_registerController@customerRegister');
Route::post('customer/register/post','Customer_registerController@customerRegisterPost');

//SocialMediaController Routes
Route::get('social/media','SocialMediaController@index');
Route::get('social/media/add','SocialMediaController@create');
Route::post('social/media/post','SocialMediaController@store');
Route::get('social/media/edit/{id}','SocialMediaController@edit');
Route::post('social/media/update','SocialMediaController@updateMedia');
Route::get('social/media/delete/{id}','SocialMediaController@delete');

//ReviewController Routes
Route::post('review','ReviewController@addReview');

//SubscribeController Routes
Route::get('subscribe','SubscribeController@index');
Route::get('subscribe/delete/{id}','SubscribeController@delete');

//FaqController Routes
Route::get('faq/list','FaqController@index');
Route::get('faq/add','FaqController@create');
Route::post('faq/add/post','FaqController@store');
Route::get('faq/edit/{id}','FaqController@edit');
Route::post('faq/update','FaqController@update');
Route::get('faq/delete/{id}','FaqController@delete');
