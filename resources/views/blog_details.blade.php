@extends('layouts.frontend_master')
@section('frontend_content')

  <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="breadcumb-wrap text-center">
                         <h2>Blog Details</h2>
                         <ul>
                             <li><a href="{{ url('/') }}">Home</a></li>
                             <li><span>{{ $post->post_title }}</span></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- .breadcumb-area end -->
     <!-- blog-details-area start-->
     <div class="blog-details-area ptb-100">
         <div class="container">
             <div class="row">
                 <div class="col-lg-9 col-12">
                     <div class="blog-details-wrap">
                         <img src="{{ asset('uploads/blog_images/'.$post->post_picture) }}" alt="Picture">
                         <h3>{{ $post->post_title }}</h3>
                         <ul class="meta">
                             <li>{{ $post->created_at->format('d M Y') }}</li>
                             <li>By {{ $post->relationToUser->name }}</li>
                         </ul>

                         {{ $post->post_description }}

                         <div class="share-wrap">
                             <div class="row">
                                 <div class="col-sm-7 ">
                                     <ul class="socil-icon d-flex">
                                         <li>share it on :</li>
                                         @foreach ($social_icons as $social_icon)
                                           <li><a href="{{ $social_icon->social_media_link }}"><i class="{{ $social_icon->icon_name }}"></i></a></li>

                                         @endforeach
                                     </ul>
                                 </div>
                                 <div class="col-sm-5 text-right">

                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="comment-form-area">
                  <!-- Comment Section Start -->
                         <div class="comment-main">
                             <h3 class="blog-title"><span>({{ $comment_total }})</span>Comments:</h3>
                             <ol class="comments">
                                 <li class="comment even thread-even depth-1">
                                   @foreach ($comments as $comment)
                                     <div class="comment-wrap">
                                         <div class="comment-theme">
                                             <div class="comment-image">
                                               @if ($comment->user->picture)
                                                 <img src="{{ asset('uploads/user_images/'.$comment->user->picture) }}" alt="{{ $comment->user->name }}">
                                               @else
                                                 <img src="{{ asset('uploads/user_images/default.png') }}" alt="" width="50">
                                               @endif
                                             </div>
                                         </div>
                                         <div class="comment-main-area">
                                             <div class="comment-wrapper">
                                                 <div class="sewl-comments-meta">
                                                     <h4>{{ $comment->user->name }} </h4>
                                                     <span>{{ $comment->created_at->format('d M Y') }} at {{ $comment->created_at->format('h:i A') }}</span>
                                                 </div>
                                                 <div class="comment-area">
                                                     <p>{{ $comment->description }}</p>
                                                 </div>
                                             </div>
                                         </div>
                                       </div>
                                   @endforeach
                                 </li>
                             </ol>
                         </div>

                  <!-- Comment Section End -->


                         <div id="respond" class="sewl-comment-form comment-respond form-style">
                             <h3 id="reply-title" class="blog-title">Leave a <span>comment</span></h3>
                             @if(session('comment_message'))
                               <div class="alert alert-danger">{{ session('comment_message') }}.</div>
                             @endif

                             <form novalidate="" method="post" id="commentform" class="comment-form" action="{{ url('add/comment') }}">
                               @csrf

                               <input type="hidden" name="post_id" value="{{ $post->id }}">
                                 <div class="row">
                                     <div class="col-12">
                                         <div class="sewl-form-textarea no-padding-right">
                                             <textarea id="comment" name="description" tabindex="4" rows="3" cols="30" placeholder="Write Your Comments..."></textarea>
                                             @error ('description')
                                               <span class="text-danger">{{ $message  }}</span>
                                             @enderror
                                         </div>
                                     </div>
                                     <div class="col-12">
                                         <div class="form-submit">
                                             <input id="submit" value="Send" type="submit">

                                         </div>
                                     </div>
                                 </div>
                             </form>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-3 col-12">
                     <aside class="sidebar-area">
                         <div class="widget widget_categories">
                             <h4 class="widget-title">Categories</h4>
                             <ul>
                               @foreach($categories as $category)
                                 <li><a href="{{ url('category/product/'.$category->id) }}">{{ $category->category_name }}</a></li>
                               @endforeach
                             </ul>
                         </div>
                         <div class="widget widget_recent_entries recent_post">
                             <h4 class="widget-title">Recent Post</h4>
                             <ul>
                               @foreach($recent_posts as $recent_post)
                                 <li>
                                     <div class="post-img">
                                         <img src="{{ asset('uploads/blog_images/'.$recent_post->post_picture) }}" alt="Picture" height="70" width="80">
                                     </div>
                                     <div class="post-content">
                                         <a href="{{ url('blog/post/'.$recent_post->id) }}">{{ $recent_post->post_title }}</a>
                                         <p>{{ $recent_post->created_at->format('d M Y') }}</p>
                                     </div>
                                 </li>
                               @endforeach
                             </ul>
                         </div>
                     </aside>
                 </div>
             </div>
         </div>
     </div>
     <!-- blog-details-area end -->

@endsection
