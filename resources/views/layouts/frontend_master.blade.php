<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Tohoney - Home Page</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{ asset('frontend_assets') }}/images/favicon.png">
    <!-- Place favicon.ico in the root directory -->
    <!-- all css here -->
    <!-- bootstrap v4.0.0-beta.2 css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/bootstrap.min.css">
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/owl.carousel.min.css">
    <!-- font-awesome v4.6.3 css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/font-awesome.min.css">
    <!-- flaticon.css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/flaticon.css">
    <!-- jquery-ui.css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/jquery-ui.css">
    <!-- metisMenu.min.css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/metisMenu.min.css">
    <!-- swiper.min.css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/swiper.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/styles.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="{{ asset('frontend_assets') }}/css/responsive.css">
    <!-- modernizr css -->
    <script src="{{ asset('frontend_assets') }}/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!--Start Preloader-->
    <div class="preloader-wrap">
        <div class="spinner"></div>
    </div>


    <!-- search-form here -->
    <div class="search-area flex-style">
        <span class="closebar">Close</span>
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 col-12">
                    <div class="search-form">
                        <form action="#">
                            <input type="text" placeholder="Search Here...">
                            <button><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search-form here -->
    <!-- header-area start -->
    <header class="header-area">
        <div class="header-top bg-2">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-md-6 col-12">
                        <ul class="d-flex header-contact">
                            <li><i class="fa fa-phone"></i> +01 123 456 789</li>
                            <li><i class="fa fa-envelope"></i> youremail@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-12">
                        <ul class="d-flex account_login-area">
                            <li>
                                <a href="javascript:void(0);"><i class="fa fa-user"></i> My Account <i class="fa fa-angle-down"></i></a>
                                <ul class="dropdown_style">
                                    <li><a href="">Logout</a></li>
                                </ul>
                            </li>
                            <li><a href="{{ url('customer/register') }}"> Login/Register </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="fluid-container">
                <div class="row">
                    <div class="col-lg-3 col-md-7 col-sm-6 col-6">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                        <img src="{{ asset('uploads/logo') }}/1.png" alt="">
                        </a>
                        </div>
                    </div>
                    <div class="col-lg-7 d-none d-lg-block">
                        <nav class="mainmenu">
                            <ul class="d-flex">
                                <li class="active"><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('about') }}">About</a></li>
                                <li><a href="{{ url('shop') }}">Shop</a></li>
                                <li><a href="{{ url('blog') }}">Blog</a></li>
                                <li><a href="{{ url('faq') }}">FAQ</a></li>
                                <li><a href="{{ url('/contact') }}">Contact</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-md-4 col-lg-2 col-sm-5 col-4">
                        <ul class="search-cart-wrapper d-flex">
                            <li class="search-tigger"><a href="javascript:void(0);"><i class="flaticon-search"></i></a></li>
                            <li>
                                <a href="javascript:void(0);"><i class="flaticon-like"></i> <span>{{ App\Wishlist::where('ip_address',request()->ip())->count() }}</span></a>
                                <ul class="cart-wrap dropdown_style">
                                  @foreach(App\Wishlist::where('ip_address',request()->ip())->limit(2)->get() as $wishlist)
                                    <li class="cart-items">
                                        <div class="cart-img">
                                            <img src="{{ asset('uploads/product_images') }}/{{ $wishlist->product->product_thumbnail_picture ?? "" }}" height="70" width="88" alt="">
                                        </div>
                                        <div class="cart-content">
                                            <a href="{{ url('single/product/description/'.$wishlist->product_id) }}">{{ $wishlist->product->product_name }}</a>
                                            <p>${{ $wishlist->product->product_price }}</p>
                                            <i class="fa fa-times"></i>
                                        </div>
                                    </li>
                                  @endforeach
                                    <li>
                                        <a href="{{ url('wishlist') }}" class="btn btn-danger">More Wishlist</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><i class="flaticon-shop"></i> <span>
                                  {{ App\Cart::where('ip_address',request()->ip())->count() }}
                                </span></a>
                                <ul class="cart-wrap dropdown_style">
                                  @php
                                    $subTotal = 0;
                                  @endphp
                                  @foreach (App\Cart::where('ip_address',request()->ip())->get() as $cart)
                                    <li class="cart-items">
                                        <div class="cart-img">
                                            <img src="{{ asset('uploads/product_images/'.$cart->product->product_thumbnail_picture) }}" height="70" width="88" alt="">
                                        </div>
                                        <div class="cart-content">
                                            <a href="{{ url('single/product/description/'.$cart->product_id) }}">{{ $cart->product->product_name }}</a>
                                            <span>QTY : {{ $cart->quantity }}</span>
                                            <p>${{ ($cart->product->product_price)*($cart->quantity) }}</p>
                                            <a href="{{ url('remove/cart/'.$cart->id) }}"><i class="fa fa-times"></i></a>
                                        </div>
                                    </li>
                                    @php
                                      $subTotal = $subTotal + ($cart->product->product_price)*($cart->quantity);
                                    @endphp
                                  @endforeach

                                    <li>Subtotol: <span class="pull-right">${{ $subTotal }}</span></li>
                                    <li>
                                        <a href="{{ url('cart') }}" class="btn btn-danger">Cart</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-1 col-sm-1 col-2 d-block d-lg-none">
                        <div class="responsive-menu-tigger">
                            <a href="javascript:void(0);">
                        <span class="first"></span>
                        <span class="second"></span>
                        <span class="third"></span>
                        </a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
            <div class="responsive-menu-area">
                <div class="container">
                    <div class="row">
                        <div class="col-12 d-block d-lg-none">
                            <ul class="metismenu">
                                <li><a href="{{ url('/') }}">Home</a></li>
                                <li><a href="{{ url('about') }}">About</a></li>
                                <li><a href="{{ url('shop') }}">Shop</a></li>
                                <li><a href="{{ url('blog') }}">Blog</a></li>
                                <li><a href="{{ url('faq') }}">FAQ</a></li>
                                <li><a href="{{ url('contact ') }}">Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- responsive-menu area start -->
        </div>
    </header>
    <!-- header-area end -->


    @yield('frontend_content')


    <!-- start social-newsletter-section -->
    <section class="social-newsletter-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="newsletter text-center">
                        <h3>Subscribe  Newsletter</h3>
                        <div class="newsletter-form">
                            <form method="post" action="{{ url('subscribe/post') }}">
                              @csrf
                                <input type="text" class="form-control" placeholder="Enter Your Email Address..." name="email">
                                <button type="submit"><i class="fa fa-send"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end container -->
    </section>
    <!-- end social-newsletter-section -->
    <!-- .footer-area start -->
    <div class="footer-area">
        <div class="footer-top">
            <div class="container">
                <div class="footer-top-item">
                    <div class="row">
                        <div class="col-lg-12 col-12">
                            <div class="footer-top-text text-center">
                                <ul>
                                    <li><a href="{{ url('/') }}">home</a></li>
                                    <li><a href="{{ url('blog') }}">Blog</a></li>
                                    <li><a href="{{ url('shop') }}">Shop</a></li>
                                    <li><a href="{{ url('faq') }}">FAQ</a></li>
                                    <li><a href="{{ url('contact') }}">contact</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2 col-md-3 col-sm-12">
                        <div class="footer-icon">
                            <ul class="d-flex">
                              @foreach (App\SocialMedia::all() as $icon)
                                <li><a href="{{ $icon->social_media_link }}"><i class="{{ $icon->icon_name }}"></i></a></li>
                              @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-8 col-sm-12">
                        <div class="footer-content">
                            <p>On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure righteous indignation and dislike</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-8 col-sm-12">
                        <div class="footer-adress">
                            <ul>
                                <li><a href="#"><span>Email:</span> domain@gmail.com</a></li>
                                <li><a href="#"><span>Tel:</span> 0131234567</a></li>
                                <li><a href="#"><span>Adress:</span> 52 Web Bangale , Adress line2 , ip:3105</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <div class="footer-reserved">
                            <ul>
                                <li>Copyright © Dipu Chandra Dey {{ \Carbon\Carbon::now()->format('Y') }}.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .footer-area end -->
    <!-- .Modal start -->
    @include('layouts.product_modal')
    <!-- .Modal end -->

    <!-- jquery latest version -->
    <script src="{{ asset('frontend_assets') }}/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap js -->
    <script src="{{ asset('frontend_assets') }}/js/bootstrap.min.js"></script>
    <!-- owl.carousel.2.0.0-beta.2.4 css -->
    <script src="{{ asset('frontend_assets') }}/js/owl.carousel.min.js"></script>
    <!-- scrollup.js -->
    <script src="{{ asset('frontend_assets') }}/js/scrollup.js"></script>
    <!-- isotope.pkgd.min.js -->
    <script src="{{ asset('frontend_assets') }}/js/isotope.pkgd.min.js"></script>
    <!-- imagesloaded.pkgd.min.js -->
    <script src="{{ asset('frontend_assets') }}/js/imagesloaded.pkgd.min.js"></script>
    <!-- jquery.zoom.min.js -->
    <script src="{{ asset('frontend_assets') }}/js/jquery.zoom.min.js"></script>
    <!-- countdown.js -->
    <script src="{{ asset('frontend_assets') }}/js/countdown.js"></script>
    <!-- swiper.min.js -->
    <script src="{{ asset('frontend_assets') }}/js/swiper.min.js"></script>
    <!-- metisMenu.min.js -->
    <script src="{{ asset('frontend_assets') }}/js/metisMenu.min.js"></script>
    <!-- mailchimp.js -->
    <script src="{{ asset('frontend_assets') }}/js/mailchimp.js"></script>
    <!-- jquery-ui.min.js -->
    <script src="{{ asset('frontend_assets') }}/js/jquery-ui.min.js"></script>
    <!-- main js -->
    <script src="{{ asset('frontend_assets') }}/js/scripts.js"></script>
    <script src="{{ asset('frontend_assets') }}/js/ajax.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#cupon-name-link').on('click',function(){
          var cupon = $("#cupon-name").val();
          var cart_url_cupon = "{{ url('cart') }}/"+cupon;
          window.location.href = cart_url_cupon;
        });
      });
    </script>

</body>


<!-- Mirrored from themepresss.com/tf/html/tohoney/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 13 Mar 2020 03:33:34 GMT -->
</html>
