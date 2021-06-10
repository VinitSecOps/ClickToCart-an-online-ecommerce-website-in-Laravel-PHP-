@php
$setting = DB::table('sitesetting')->first();
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        
        $seo = DB::table('seo')->first();
        
    @endphp
    <title><?php echo $seo->meta_title; ?></title>
    <meta charset="utf-8">
    <meta name="author" content="<?php echo $seo->meta_author; ?>">
    <meta name="keywords" content="<?php echo $seo->meta_tag; ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo $seo->meta_description; ?>">
    <meta name="google-site-verification"
        content="<?php echo $seo->google_analytics; ?>">
    <meta name="bing-site-verification" content="<?php echo $seo->bing_analytics; ?>">
    <meta name="csrf-token" content="content">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="shortcut icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">  
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/bootstrap4/bootstrap.min.css') }}">
    <link href="{{ asset('public/frontend/plugins/fontawesome-free-5.0.1/css/fontawesome-all.css') }}"
        rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.css') }} ">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('public/frontend/plugins/OwlCarousel2-2.2.1/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/plugins/slick-1.8.0/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/main_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/responsive.css') }}">
    <!-- Toaster CSS -->
    <link rel="stylesheet" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://js.stripe.com/v3/"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <style>
        .dropdown-menu{
            width: 502px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }
    </style>


</head>

<body>



    <div class="super_container">

        <!-- Header -->

        <header class="header">

            <!-- Top Bar -->

            <div class="top_bar">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex flex-row">
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon"><img src="{{ asset('public/frontend/images/phone.png') }}"
                                        alt=""></div><a
                                    href="tel:{{ $setting->phone_one }}">+91{{ $setting->phone_one }}</a>
                            </div>
                            <div class="top_bar_contact_item">
                                <div class="top_bar_icon"><img src="{{ asset('public/frontend/images/mail.png') }}"
                                        alt=""></div><a
                                    href="mailto:{{ $setting->email }}">{{ $setting->email }}</a>
                            </div>
                            <div class="top_bar_content ml-auto">







                                <div class="top_bar_menu">
                                    <ul class="standard_dropdown top_bar_dropdown">
                                        <li>
                                            <a href="#">Languages<i class="fas fa-chevron-down"></i></a>
                                            <ul>
                                                @if (Session::has('lang'))
                                                    @if (Session()->get('lang') == 'english')
                                                        <li><a href="{{ route('language.hindi') }}">Hindi</a></li>
                                                        <li><a href="{{ route('language.gujarati') }}">Gujarati</a>
                                                        </li>
                                                    @endif

                                                    @if (Session()->get('lang') == 'hindi')
                                                        <li><a href="{{ route('language.english') }}">English</a>
                                                        </li>
                                                        <li><a href="{{ route('language.gujarati') }}">Gujarati</a>
                                                        </li>
                                                    @endif

                                                    @if (Session()->get('lang') == 'gujarati')
                                                        <li><a href="{{ route('language.english') }}">English</a>
                                                        </li>
                                                        <li><a href="{{ route('language.hindi') }}">Hindi</a></li>
                                                    @endif
                                                @else
                                                    <li><a href="{{ route('language.english') }}">English</a></li>
                                                    <li><a href="{{ route('language.hindi') }}">Hindi</a></li>
                                                    <li><a href="{{ route('language.gujarati') }}">Gujarati</a></li>
                                                @endif


                                            </ul>
                                        </li>

                                    </ul>

                                </div>
                                <div class="top_bar_user">
                                    @guest
                                        <div class="user_icon"><img src="{{ asset('public/frontend/images/user.svg') }}"
                                                alt=""></div>
                                        <div><a href="{{ route('register') }}">Register</a></div>
                                        <div><a href="{{ route('login') }}">Sign in</a></div>
                                    @else
                                        <ul class="standard_dropdown top_bar_dropdown">
                                            <li>
                                                <a href="{{ route('home') }}">
                                                    <div class="user_icon"><img
                                                            src="{{ asset('public/frontend/images/user.svg') }}" alt="">
                                                    </div>Profile<i class="fas fa-chevron-down"></i>
                                                </a>
                                                <ul>
                                                    
                                                    <li><a href="{{ route('home') }}">Orders</a></li>
                                                    <li><a href="{{ route('user.wishlist') }}">Wishlist</a></li>
                                                    <li><a href="{{ url('profile') }}">Edit profile</a></li>
                                                    <li><a href="{{ route('password.change') }}">Change password</a></li>
                                                    <li><a href="{{ route('user.logout') }}"
                                                            class="text text-danger">Logout</a></li>
                                                </ul>
                                            </li>

                                        </ul>
                                    @endguest

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Header Main -->

            <div class="header_main">
                <div class="container">
                    <div class="row" style="
                    z-index: 2;
                ">

                        <!-- Logo -->
                        <div class="col-lg-2 col-sm-3 col-3 order-1">
                            <div class="logo_container">
                                <div class="logo"><a href="{{ url('/') }}"><img
                                            src="{{ asset($setting->logo) }}" alt=""></a></div>
                            </div>
                        </div>



                        <!-- Search -->
                        <div class="col-lg-6 col-12 order-lg-2 order-3 text-lg-left text-right">
                            <div class="header_search">
                                <div class="header_search_content">
                                    <div class="header_search_form_container">
                                        <form action="{{ route('product.search') }}"
                                            class="header_search_form clearfix" method="GET">
                                            @csrf
                                           
                                            <input type="search" name="search" id="search" required="required"
                                                class="header_search_input" placeholder="Search for products..." class="typeahead" autocomplete="off">
                                                <input type="hidden" name="sort" value="name">
                                            <div class="custom_dropdown">
                                                <div class="custom_dropdown_list">
                                                    <span class="custom_dropdown_placeholder clc" onclick="$('ul.custom_list').addClass('active');">All Categories</span>
                                                    <i class="fas fa-chevron-down"></i>
                                                    <ul class="custom_list clc">
                                                        @php
                                                            
                                                            $categories = DB::table('categories')->get();
                                                            
                                                        @endphp


                                                        @foreach ($categories as $row)
                                                            <li><a class="clc" href="#">{{ $row->category_name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                               
                                                
                                            </div>
                                            <button type="submit" class="header_search_button trans_300"
                                                value="Submit"><img
                                                    src="{{ asset('public/frontend/images/search.png') }}"
                                                    alt=""></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Wishlist -->
                        <div class="col-lg-4 col-9 order-lg-3 order-2 text-lg-left text-right">
                            <div class="wishlist_cart d-flex flex-row align-items-center justify-content-end">
                                <div class="wishlist d-flex flex-row align-items-center justify-content-end">
                                    @guest

                                    @else

                                        @php
                                            $wishlists = DB::table('wishlists')
                                                ->where('user_id', Auth::id())
                                                ->get();
                                        @endphp

                                        <div class="wishlist_icon"><img
                                                src="{{ asset('public/frontend/images/heart.png') }}" alt=""></div>
                                        <div class="wishlist_content">
                                            <div class="wishlist_text"><a
                                                    href="{{ route('user.wishlist') }}">Wishlist</a></div>
                                            <div class="wishlist_count">{{ count($wishlists) }}</div>
                                        </div>
                                    </div>
                                @endguest


                                <!-- Cart -->
                                <div class="cart">
                                    <div class="cart_container d-flex flex-row align-items-center justify-content-end">
                                        <div class="cart_icon">
                                            <img src="{{ asset('public/frontend/images/cart.png') }}" alt="">
                                            <div class="cart_count"><span>{{ Cart::count() }}</span></div>
                                        </div>
                                        <div class="cart_content">
                                            <div class="cart_text"><a href="{{ route('show.cart') }}">Cart</a></div>
                                            <div class="cart_price">&#8377;{{ Cart::subtotal() }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>





            @yield('content')
            <!-- Newsletter -->

            <div class="newsletter">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div
                                class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
                                <div class="newsletter_title_container">
                                    <div class="newsletter_icon"><img
                                            src="{{ asset('public/frontend/images/send.png') }}" alt=""></div>
                                    <div class="newsletter_title">Sign up for Newsletter</div>
                                    <div class="newsletter_text">
                                        <p>...and receive new offers.</p>
                                    </div>
                                </div>
                                <div class="newsletter_content clearfix">
                                    <form action="{{ route('store.newsletter') }}" method="POST"
                                        class="newsletter_form" id="main_form">
                                        @csrf
                                        <input type="email" name="email" class="newsletter_input" required="required"
                                            placeholder="Enter your email address">

                                        <strong class="text-success error-text email_error"></strong>

                                        <button class="newsletter_button" type="submit">Subscribe</button>

                                        @if (Auth::user())
                                            @if (DB::table('newsletter')->where('email', Auth::user()->email)->first())
                                                <div class="newsletter_unsubscribe_link"><a
                                                        href="{{ url('unsubscribe/newsletter/' . Auth::user()->email) }}">unsubscribe</a>
                                                </div>
                                            @else
                                            @endif
                                        @else

                                        @endif

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->

            <footer class="footer">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 footer_col">
                            <div class="footer_column footer_contact">
                                <div class="logo_container">
                                    <div class="logo"><a href="{{ url('/') }}">{{ $setting->company_name }}</a>
                                    </div>
                                </div>
                                <div class="footer_title">Got Question? Call Us 24/7</div>
                                <div class="footer_phone"><a href="tel:{{ $setting->phone_two }}"
                                        class="text-dark">+91{{ $setting->phone_two }}</a></div>
                                <div class="footer_contact_text">
                                    <p>{{ $setting->company_address }}</p>
                                </div>
                                <div class="footer_social">
                                    <ul>
                                        <li><a href="{{ $setting->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li><a href="{{ $setting->twitter }}"><i class="fab fa-twitter"></i></a></li>
                                        <li><a href="{{ $setting->youtube }}"><i class="fab fa-youtube"></i></a></li>
                                        <li><a href="{{ $setting->instagram }}"><i class="fab fa-instagram"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2 offset-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">Popular Category</div>
                                <ul class="footer_list">
                                    @foreach ($categories as $row)
                                        <li><a
                                                href="{{ url('allcategory/' . $row->id . '/name') }}">{{ $row->category_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>

                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">Get to Know Us</div>
                                <ul class="footer_list">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ url('contact/page') }}">Contact us</a></li>
                                    <li><a href="{{ url('blog/post') }}">Blog</a></li>
                                    <li><a href="{{ url('about/us') }}">About us</a></li>
                                    <li><a href="{{ url('contact/page') }}">ClickToCart care</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="footer_column">
                                <div class="footer_title">Term & Condition</div>
                                <ul class="footer_list">
                                    <li><a href="{{ route('disclaimer') }}">Disclaimer</a></li>
                                    <li><a href="{{ route('policy') }}">Privacy Policy</a></li>
                                    <li><a href="{{ route('safe') }}">Safe Secured Shopping</a></li>
                                    <li><a href="{{ route('terms') }}">Terms of Use</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </footer>

            <!-- Copyright -->

            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col">

                            <div
                                class="copyright_container d-flex flex-sm-row flex-column align-items-center justify-content-start">
                                <div class="copyright_content">
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                    Copyright &copy;<script>
                                        document.write(new Date().getFullYear());

                                    </script> All rights reserved by <a href="{{ url('/') }}">ClickToCart.com</a>
                                    <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                </div>
                                <div class="logos ml-sm-auto">
                                    <ul class="logos_list">
                                        <li><img src="{{ asset('public/frontend/images/logos_1.png') }}" alt=""></li>
                                        <li><img src="{{ asset('public/frontend/images/logos_2.png') }}" alt=""></li>
                                        <li><img src="{{ asset('public/frontend/images/logos_3.png') }}" alt=""></li>
                                        <li><img src="{{ asset('public/frontend/images/logos_4.png') }}" alt=""></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>






    <script src="{{ asset('public/frontend/js/jquery-3.3.1.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <script src="{{ asset('public/frontend/plugins/greensock/TweenMax.min.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/greensock/TimelineMax.min.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/scrollmagic/ScrollMagic.min.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/greensock/animation.gsap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/greensock/ScrollToPlugin.min.js') }}">
    </script>
    <script src="{{ asset('public/frontend/plugins/OwlCarousel2-2.2.1/owl.carousel.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/slick-1.8.0/slick.js') }}"></script>
    <script src="{{ asset('public/frontend/plugins/easing/easing.js') }}"></script>
    <script src="{{ asset('public/frontend/js/custom.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>
    <script src="{{ asset('public/frontend/js/product_custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    

    <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="text/javascript">
        @if (Session::has('messege'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
            case 'info':
            toastr.info("{{ Session::get('messege') }}");
            break;
            case 'success':
            toastr.success("{{ Session::get('messege') }}");
            break;
            case 'warning':
            toastr.warning("{{ Session::get('messege') }}");
            break;
            case 'error':
            toastr.error("{{ Session::get('messege') }}");
            break;
            }
        @endif

    </script>




    <script>
        $(function() {

            $("#main_form").on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    beforeSend: function() {
                        $(document).find('strong.error-text').text('');
                    },
                    success: function(data) {
                        if (data.status == 0) {
                            $.each(data.error, function(prefix, val) {
                                $('strong.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            $('#main_form')[0].reset();
                            toastr[data.type](data.msg);
                        }
                    }
                });
            });
        });

    </script>

    <script>
        $(document).on("click", "#return", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                    title: "Are you Want to Return?",
                    text: "Once returned, money will be credited into your account",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    } else {
                        swal("Great!", "Changed your mind!", "success");
                    }
                });
        });

    </script>

 

    <script>
        var path = '{{ URL::to('search-product') }}';

        $('#search').typeahead({
            source: function(terms,process){
                return $.get(path,{terms:terms},function(data){
                    return process(data);
                });
            }
        });

       
    </script>

</body>

</html>
