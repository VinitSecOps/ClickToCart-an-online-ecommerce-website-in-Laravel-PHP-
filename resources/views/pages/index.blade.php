@extends('layouts.app')
@section('content')
    @include('layouts.menubar')
    @include('layouts.slider')
    @php
    $featured = DB::table('products')
        ->where('status', 1)
        ->inRandomOrder()
        ->limit(12)
        ->get();

    $trending = DB::table('products')
        ->join('categories', 'products.category_id', 'categories.id')
        ->select('products.*', 'categories.category_name')
        ->where('status', 1)
        ->where('trend', 1)
        ->orderBy('updated_at','DESC')
        ->limit(12)
        ->get();

    $best_rated = DB::table('products')
        ->where('status', 1)
        ->where('best_rated', 1)
        ->orderBy('updated_at','DESC')
        ->limit(8)
        ->get();

    $hot_deal = DB::table('products')
        ->join('brands', 'products.brand_id', 'brands.id')
        ->select('products.*', 'brands.brand_name')
        ->where('products.status', 1)
        ->where('products.hot_deal', 1)
        ->orderBy('updated_at','DESC')
        ->limit(3)
        ->get();

    $hot_new = DB::table('products')
        ->where('status', 1)
        ->where('hot_new', 1)
        ->orderBy('updated_at','DESC')
        ->limit(6)
        ->get();

    $mid_slider = DB::table('products')
        ->join('categories', 'products.category_id', 'categories.id')
        ->join('brands', 'products.brand_id', 'brands.id')
        ->select('products.*', 'brands.brand_name', 'categories.category_name')
        ->where('products.status', 1)
        ->where('products.mid_slider', 1)
        ->orderBy('updated_at','DESC')
        ->limit(3)
        ->get();

    @endphp
    <!-- Characteristics -->

    <div class="characteristics">
        <div class="container">
            <div class="row">

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend/images/char_1.png') }}" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Free Delivery</div>
                            <div class="char_subtitle">from &#8377; 5,000</div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend/images/char_2.png') }}" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Easy Return</div>
                            <div class="char_subtitle">within 7 days</div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend/images/char_3.png') }}" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Money Back</div>
                            <div class="char_subtitle">guaranteed</div>
                        </div>
                    </div>
                </div>

                <!-- Char. Item -->
                <div class="col-lg-3 col-md-6 char_col">

                    <div class="char_item d-flex flex-row align-items-center justify-content-start">
                        <div class="char_icon"><img src="{{ asset('public/frontend/images/char_4.png') }}" alt=""></div>
                        <div class="char_content">
                            <div class="char_title">Offers</div>
                            <div class="char_subtitle">every week</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Deals of the week -->

    <div class="deals_featured">
        <div class="container">
            <div class="row">
                <div class="col d-flex flex-lg-row flex-column align-items-center justify-content-start">

                    <!-- Deals -->

                    <div class="deals">
                        <div class="deals_title">Deals of the Week</div>
                        <div class="deals_slider_container">

                            <!-- Deals Slider -->
                            <div class="owl-carousel owl-theme deals_slider">
                                @foreach ($hot_deal as $row)
                                    <!-- Deals Item -->
                                    <div class="owl-item deals_item">
                                        <div class="deals_image"><img src="{{ asset($row->image_one) }}" alt=""></div>
                                        <div class="deals_content">
                                            <div class="deals_info_line d-flex flex-row justify-content-start">
                                                <div class="deals_item_category"><a href="#">{{ $row->brand_name }}</a>
                                                </div>

                                                @if ($row->discount_price == null)

                                                @else
                                                    <div class="deals_item_price_a ml-auto">
                                                        &#8377;{{ $row->selling_price }}</div>
                                                @endif

                                            </div>
                                            <div class="deals_info_line d-flex flex-row justify-content-start">
                                                <div class="deals_item_name"><a
                                                    href="{{ url('product/details/' . $row->id) }}" class="text-dark">{{ $row->product_name }}</a></div>

                                                @if ($row->discount_price == null)
                                                    <div class="deals_item_price ml-auto">&#8377;{{ $row->selling_price }}
                                                    </div>
                                                @else

                                                @endif

                                                @if ($row->discount_price != null)
                                                    <div class="deals_item_price ml-auto">
                                                        &#8377;{{ $row->discount_price }}</div>
                                                @else

                                                @endif


                                            </div>
                                            <div class="available">
                                                <div class="available_line d-flex flex-row justify-content-start">
                                                    <div class="available_title">Available:
                                                        <span>{{ $row->product_quantity }}</span>
                                                    </div>
                                                    <div class="sold_title ml-auto">Already sold: <span>{{ (100-$row->product_quantity) }}</span></div>
                                                </div>
                                                <div class="available_bar"><span style="width:{{ $row->product_quantity }}%"></span></div>
                                            </div>
                                            <div
                                                class="deals_timer d-flex flex-row align-items-center justify-content-start">
                                                <div class="deals_timer_title_container">
                                                    <div class="deals_timer_title">Hurry Up</div>
                                                    <div class="deals_timer_subtitle">Offer ends in:</div>
                                                </div>
                                                <div class="deals_timer_content ml-auto">
                                                    <div class="deals_timer_box clearfix" data-target-time="">
                                                        <div class="deals_timer_unit">
                                                            <div id="deals_timer1_hr" class="deals_timer_hr"></div>
                                                            <span>hours</span>
                                                        </div>
                                                        <div class="deals_timer_unit">
                                                            <div id="deals_timer1_min" class="deals_timer_min"></div>
                                                            <span>mins</span>
                                                        </div>
                                                        <div class="deals_timer_unit">
                                                            <div id="deals_timer1_sec" class="deals_timer_sec"></div>
                                                            <span>secs</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>

                        </div>

                        <div class="deals_slider_nav_container">
                            <div class="deals_slider_prev deals_slider_nav"><i class="fas fa-chevron-left ml-auto"></i>
                            </div>
                            <div class="deals_slider_next deals_slider_nav"><i class="fas fa-chevron-right ml-auto"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Featured -->
                    <div class="featured">
                        <div class="tabbed_container">
                            <div class="tabs">
                                <ul class="clearfix">
                                    <li class="active">Featured</li>
                                </ul>
                                <div class="tabs_line"><span></span></div>
                            </div>

                            <!-- Product Panel -->
                            <div class="product_panel panel active">
                                <div class="featured_slider slider">

                                    @foreach ($featured as $row)
                                        <!-- Slider Item -->
                                        <div class="featured_slider_item">
                                            <div class="border_active"></div>
                                            <div
                                                class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <div
                                                    class="product_image d-flex flex-column align-items-center justify-content-center">
                                                    <img src="{{ asset($row->image_one) }}" alt="" height="120px"
                                                        width="100px">
                                                </div>
                                                <div class="product_content">
                                                    <div class="product_price discount">
                                                        @if ($row->discount_price == '')
                                                            &#8377;{{ $row->selling_price }}<span></span>
                                                        @else
                                                            &#8377;{{ $row->discount_price }}<span>&#8377;{{ $row->selling_price }}</span>
                                                        @endif

                                                    </div>
                                                    <div class="product_name">
                                                        <div><a
                                                                href="{{ url('product/details/' . $row->id) }}">{{ $row->product_name }}</a>
                                                        </div>
                                                    </div>
                                                    <div class="product_extras">

                                                        {{-- <button class="product_cart_button addcart"
                                                            data-id="{{ $row->id }}">Add to Cart</button> --}}
                                                        <button id="{{ $row->id }}" class="product_cart_button"
                                                            data-bs-toggle="modal" data-bs-target="#cartmodal"
                                                            onclick="productview(this.id)">Add to Cart</button>
                                                    </div>
                                                </div>
                                                <button class="addwishlist" data-id="{{ $row->id }}"
                                                    style="border:none">
                                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                </button>
                                                <ul class="product_marks">
                                                    @if ($row->product_quantity <= 0)
                                                        <li class="product_mark product_discount" style="width: 172%;">OUT OF STOCK</li>
                                                    @else
                                                        @if ($row->discount_price == '')
                                                            <li class="product_mark product_discount"
                                                                style="background: #0e8ce4;">
                                                                New</li>
                                                        @else
                                                            <li class="product_mark product_discount">
                                                                @php
                                                                    $amount = $row->selling_price - $row->discount_price;
                                                                    $discount = ($amount / $row->selling_price) * 100;
                                                                    
                                                                @endphp
                                                                {{ intval($discount) }}%
                                                            </li>
                                                        @endif

                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="featured_slider_dots_cover"></div>
                            </div>



                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Popular Categories -->

    <div class="popular_categories">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="popular_categories_content">
                        <div class="popular_categories_title">Popular Categories</div>
                        <div class="popular_categories_slider_nav">
                            <div class="popular_categories_prev popular_categories_nav"><i
                                    class="fas fa-angle-left ml-auto"></i></div>
                            <div class="popular_categories_next popular_categories_nav"><i
                                    class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                    </div>
                </div>

                @php
                    $categories = DB::table('categories')->get();
                @endphp

                <!-- Popular Categories Slider -->

                <div class="col-lg-9">
                    <div class="popular_categories_slider_container">
                        <div class="owl-carousel owl-theme popular_categories_slider">

                            @foreach ($categories as $row)
                                <!-- Popular Categories Item -->
                                <div class="owl-item">
                                    <div
                                        class="popular_category d-flex flex-column align-items-center justify-content-center">
                                        <div class="popular_category_image">
                                            @if ($row->category_name == "Men's Wear")
                                            <img
                                            src="{{ asset('public/frontend/images/men.png') }}" alt="">
                                            @elseif ($row->category_name == "Women's Wear")
                                            <img
                                            src="{{ asset('public/frontend/images/women.png') }}" alt="">
                                            @elseif ($row->category_name == "Kid's Wear")
                                            <img
                                            src="{{ asset('public/frontend/images/kid.jpg') }}" alt="">
                                            @elseif ($row->category_name == "Bagpacks")
                                            <img
                                            src="{{ asset('public/frontend/images/bag.png') }}" alt="">
                                            @else
                                            <img
                                            src="{{ asset('public/frontend/images/popular_1.png') }}" alt="">
                                            @endif
                                          </div>
                                        <div class="popular_category_text"> <a href="{{ url('allcategory/'.$row->id.'/name') }}" class="text-dark">{{ $row->category_name }}</a></div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Banner -->

    <div class="banner_2">
        <div class="banner_2_background"
            style="background-image:url({{ asset('public/frontend/images/banner_2_background.jpg') }})"></div>
        <div class="banner_2_container">
            <div class="banner_2_dots"></div>
            <!-- Banner 2 Slider -->

            <div class="owl-carousel owl-theme banner_2_slider">
                @foreach ($mid_slider as $row)
                    <!-- Banner 2 Slider Item -->
                    <div class="owl-item">
                        <div class="banner_2_item">
                            <div class="container fill_height">
                                <div class="row fill_height">
                                    <div class="col-lg-4 col-md-6 fill_height">
                                        <div class="banner_2_content">
                                            <div class="banner_2_category">
                                                <h4>{{ $row->category_name }}</h4>
                                            </div>
                                            <div class="banner_2_title">{{ $row->product_name }}</div>
                                            <div class="banner_2_text">{{ $row->brand_name }}<br>
                                                
                                                <div class="product_price discount"><h2>
                                                    @if ($row->discount_price == '')
                                                        &#8377;{{ $row->selling_price }}<span></span>
                                                    @else
                                                        &#8377;{{ $row->discount_price }}<span>&#8377;{{ $row->selling_price }}</span>
                                                    @endif

                                                </h2></div>
                                                
                                            </div>
                                            
                                            <div class="button banner_2_button"><a href="{{ url('product/details/' . $row->id) }}">Explore</a></div>
                                        </div>

                                    </div>
                                    <div class="col-lg-8 col-md-6 fill_height">
                                        <div class="banner_2_image_container">
                                            <div class="banner_2_image"><img src="{{ asset($row->image_one) }}" alt=""
                                                    style="height:400px; width:400px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Hot New Category One -->

    @php
    $category_one_name = DB::table('categories')->first();
    $category_one_id = $category_one_name->id;

    $product_category_one = DB::table('products')
        ->where('status', 1)
        ->where('category_id', $category_one_id)
        ->limit(10)
        ->inRandomOrder()
        ->get();

    @endphp

    <div class="new_arrivals" >
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title">{{ $category_one_name->category_name }}</div>
                            <ul class="clearfix">
                                <li class="active"></li>

                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="z-index:1;">

                                <!-- Product Panel -->
                                <div class="product_panel panel active">
                                    <div class="arrivals_slider slider">

                                        <!-- Slider Item -->
                                        @foreach ($product_category_one as $row)
                                            <!-- Slider Item -->
                                            <div class="featured_slider_item">
                                                <div class="border_active"></div>
                                                <div
                                                    class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                    <div
                                                        class="product_image d-flex flex-column align-items-center justify-content-center">
                                                        <img src="{{ asset($row->image_one) }}" alt="" height="120px"
                                                            width="100px">
                                                    </div>
                                                    <div class="product_content">
                                                        <div class="product_price discount">
                                                            @if ($row->discount_price == '')
                                                                &#8377;{{ $row->selling_price }}<span></span>
                                                            @else
                                                                &#8377;{{ $row->discount_price }}<span>&#8377;{{ $row->selling_price }}</span>
                                                            @endif
    
                                                        </div>
                                                        <div class="product_name">
                                                            <div><a
                                                                    href="{{ url('product/details/' . $row->id) }}">{{ $row->product_name }}</a>
                                                            </div>
                                                        </div>
                                                        <div class="product_extras">
    
                                                            {{-- <button class="product_cart_button addcart"
                                                                data-id="{{ $row->id }}">Add to Cart</button> --}}
                                                            <button id="{{ $row->id }}" class="product_cart_button"
                                                                data-bs-toggle="modal" data-bs-target="#cartmodal"
                                                                onclick="productview(this.id)">Add to Cart</button>
                                                        </div>
                                                    </div>
                                                    <button class="addwishlist" data-id="{{ $row->id }}"
                                                        style="border:none">
                                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                    </button>
                                                    <ul class="product_marks">
                                                        @if ($row->product_quantity <= 0)
                                                            <li class="product_mark product_discount" style="width: 250%;">OUT OF STOCK</li>
                                                        @else
                                                            @if ($row->discount_price == '')
                                                                <li class="product_mark product_discount"
                                                                    style="background: #0e8ce4;">
                                                                    New</li>
                                                            @else
                                                                <li class="product_mark product_discount">
                                                                    @php
                                                                        $amount = $row->selling_price - $row->discount_price;
                                                                        $discount = ($amount / $row->selling_price) * 100;
                                                                        
                                                                    @endphp
                                                                    {{ intval($discount) }}%
                                                                </li>
                                                            @endif
    
                                                        @endif
    
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="arrivals_slider_dots_cover"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Hot New Category Two -->

    @php
    $category_one_name = DB::table('categories')
        ->skip(1)
        ->first();
    $category_one_id = $category_one_name->id;

    $product_category_one = DB::table('products')
        ->where('status', 1)
        ->where('category_id', $category_one_id)
        ->limit(10)
        ->inRandomOrder()
        ->get();

    @endphp

    <div class="new_arrivals" >
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title">{{ $category_one_name->category_name }}</div>
                            <ul class="clearfix">
                                <li class="active"></li>

                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="z-index:1;">

                                <!-- Product Panel -->
                                <div class="product_panel panel active">
                                    <div class="arrivals_slider slider">

                                        <!-- Slider Item -->
                                        @foreach ($product_category_one as $row)
                                            <!-- Slider Item -->
                                            <div class="featured_slider_item">
                                                <div class="border_active"></div>
                                                <div
                                                    class="product_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                    <div
                                                        class="product_image d-flex flex-column align-items-center justify-content-center">
                                                        <img src="{{ asset($row->image_one) }}" alt="" height="120px"
                                                            width="100px">
                                                    </div>
                                                    <div class="product_content">
                                                        <div class="product_price discount">
                                                            @if ($row->discount_price == '')
                                                                &#8377;{{ $row->selling_price }}<span></span>
                                                            @else
                                                                &#8377;{{ $row->discount_price }}<span>&#8377;{{ $row->selling_price }}</span>
                                                            @endif
    
                                                        </div>
                                                        <div class="product_name">
                                                            <div><a
                                                                    href="{{ url('product/details/' . $row->id) }}">{{ $row->product_name }}</a>
                                                            </div>
                                                        </div>
                                                        <div class="product_extras">
    
                                                            {{-- <button class="product_cart_button addcart"
                                                                data-id="{{ $row->id }}">Add to Cart</button> --}}
                                                            <button id="{{ $row->id }}" class="product_cart_button"
                                                                data-bs-toggle="modal" data-bs-target="#cartmodal"
                                                                onclick="productview(this.id)">Add to Cart</button>
                                                        </div>
                                                    </div>
                                                    <button class="addwishlist" data-id="{{ $row->id }}"
                                                        style="border:none">
                                                        <div class="product_fav"><i class="fas fa-heart"></i></div>
                                                    </button>
                                                    <ul class="product_marks">
                                                        @if ($row->product_quantity <= 0)
                                                            <li class="product_mark product_discount" style="width: 250%;">OUT OF STOCK</li>
                                                        @else
                                                            @if ($row->discount_price == '')
                                                                <li class="product_mark product_discount"
                                                                    style="background: #0e8ce4;">
                                                                    New</li>
                                                            @else
                                                                <li class="product_mark product_discount">
                                                                    @php
                                                                        $amount = $row->selling_price - $row->discount_price;
                                                                        $discount = ($amount / $row->selling_price) * 100;
                                                                        
                                                                    @endphp
                                                                    {{ intval($discount) }}%
                                                                </li>
                                                            @endif
    
                                                        @endif
    
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                    <div class="arrivals_slider_dots_cover"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Best Sellers -->

    <div class="best_sellers">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="tabbed_container">
                        <div class="tabs clearfix tabs-right">
                            <div class="new_arrivals_title">Trending products</div>
                            <ul class="clearfix">
                                <li class="active">Hot 12</li>
                               
                            </ul>
                            <div class="tabs_line"><span></span></div>
                        </div>

                        <div class="bestsellers_panel panel active">

                            <!-- Best Sellers Slider -->

                            <div class="bestsellers_slider slider">
                                @foreach ($trending as $row)
                                <!-- Best Sellers Item -->
                                <div class="bestsellers_item discount">
                                    <div
                                        class="bestsellers_item_container d-flex flex-row align-items-center justify-content-start">
                                        <div class="bestsellers_image"><img
                                                src="{{ asset($row->image_one) }}" alt=""></div>
                                        <div class="bestsellers_content">
                                            <div class="bestsellers_category"><a href="#" tabindex="0">{{ $row->category_name }}</a></div>
                                            <div class="bestsellers_name"><a
                                                href="{{ url('product/details/' . $row->id) }}">{{ $row->product_name }}</a></div>
                                           
                                            <div class="bestsellers_price discount"><div class="product_price discount">
                                                @if ($row->discount_price == '')
                                                    &#8377;{{ $row->selling_price }}
                                                @else
                                                    &#8377;{{ $row->discount_price }}<span>&#8377;{{ $row->selling_price }}</span>
                                                @endif

                                            </div></div>
                                        </div>
                                    </div>
                                   
                                    <ul class="bestsellers_marks">
                                        @if ($row->product_quantity <= 0)
                                                        <li class="bestsellers_mark bestsellers_discount" style="width: 172%;">OUT OF STOCK</li>
                                                    @else
                                                        @if ($row->discount_price == '')
                                                        <li class="bestsellers_mark bestsellers_discount" style="background: #0e8ce4;">New</li>
                                                        @else
                                                        <li class="bestsellers_mark bestsellers_discount">
                                                                @php
                                                                    $amount = $row->selling_price - $row->discount_price;
                                                                    $discount = ($amount / $row->selling_price) * 100;
                                                                    
                                                                @endphp
                                                                {{ intval($discount) }}%
                                                            </li>
                                                        @endif

                                                    @endif
                                       
                                        
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Adverts -->

    <div class="adverts">
        <div class="container">
            <h3>Offers</h3>
           
            <hr>
            <br>
            <div class="row">
            @php
                $offers = DB::table('coupons')->orderBy('id','DESC')->limit(3)->get();
            @endphp

                @foreach ($offers as $row)
                    
               
                <div class="col-lg-4 advert_col">

                    <!-- Advert Item -->

                    <div class="advert d-flex flex-row align-items-center justify-content-start">
                        <div class="advert_content">
                            <div class="advert_title"><a href="#">{{ $row->coupon }}</a></div>
                            <div class="advert_text">Get flat {{ $row->discount }}% discount on all of your purchase just by using {{ $row->coupon }}.</div>
                        </div>
                        <div class="ml-auto">
                            <div class="advert_image"><img src="{{ asset($row->image) }}" alt="" style="height: 150px; width: 150px;">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
               

            </div>
        </div>
    </div>

    <!-- Trends -->

    <div class="trends">
        <div class="trends_background"
            style="background-image:url({{ asset('public/frontend/images/trends_background.jpg') }})"></div>
        <div class="trends_overlay"></div>
        <div class="container">
            <div class="row">

                <!-- Trends Content -->
                <div class="col-lg-3">
                    <div class="trends_container">
                        <h2 class="trends_title">Buy one Get one</h2>
                        <div class="trends_text">
                            <p>Hurry up to get this special offer, just a click away to buy this product.</p>
                        </div>
                        <div class="trends_slider_nav">
                            <div class="trends_prev trends_nav"><i class="fas fa-angle-left ml-auto"></i></div>
                            <div class="trends_next trends_nav"><i class="fas fa-angle-right ml-auto"></i></div>
                        </div>
                    </div>
                </div>
                @php
                    $buyone_getone = DB::table('products')
                        ->join('brands', 'products.brand_id', 'brands.id')
                        ->select('products.*', 'brands.brand_name')
                        ->where('products.status', 1)
                        ->where('products.buyone_getone', 1)
                        ->orderBy('updated_at','DESC')
                        ->limit(6)
                        ->get();
                @endphp
                <!-- Trends Slider -->
                <div class="col-lg-9">
                    <div class="trends_slider_container">

                        <!-- Trends Slider -->

                        <div class="owl-carousel owl-theme trends_slider">

                            <!-- Trends Slider Item -->

                            @foreach ($buyone_getone as $row)


                                <div class="owl-item">
                                    <div class="trends_item is_new">
                                        <div
                                            class="trends_image d-flex flex-column align-items-center justify-content-center">
                                            <img src="{{ asset($row->image_one) }}" alt="">
                                        </div>
                                        <div class="trends_content">
                                            <div class="trends_category"><a href="#">{{ $row->brand_name }}</a></div>
                                            <div class="trends_info clearfix">
                                                <div class="trends_name"><a href="{{ url('product/details/' . $row->id) }}">{{ $row->product_name }}</a></div>
                                                @if ($row->discount_price == '')
                                                    <div class="product_price discount">
                                                        {{ $row->selling_price }}<span></span></div>
                                                @else
                                                    <div class="product_price discount">
                                                        &#8377;{{ $row->discount_price }}<span>&#8377;{{ $row->selling_price }}</span>
                                                    </div>
                                                @endif
                                            </div><br>
                                            <a href="{{ url('product/details/' . $row->id) }}" class="btn btn-danger  btn-block">Add to Cart</a>
                                        </div>
                                        <ul class="trends_marks">
                                            <li class="trends_mark trends_discount">-25%</li>
                                            <li class="trends_mark trends_new">BuyGet</li>
                                        </ul>
                                        <button class="addwishlist" data-id="{{ $row->id }}" style="border:none">
                                            <div class="trends_fav"><i class="fas fa-heart"></i></div>
                                        </button>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Reviews -->

    <div class="reviews">
        <div class="container">
            <div class="row">
                <div class="col">

                    <div class="reviews_title_container">
                        <h3 class="reviews_title">Hot new arrivals</h3>
                    </div>

                    <div class="reviews_slider_container">

                        <!-- Reviews Slider -->
                        <div class="owl-carousel owl-theme reviews_slider">

                            <!-- Reviews Slider Item -->
                            @foreach ($hot_new as $row)
                            <div class="owl-item">
                                <div class="review d-flex flex-row align-items-start justify-content-start">
                                    <div>
                                        <div class="review_image"><img
                                                src="{{ asset($row->image_one) }}" alt=""></div>
                                    </div>
                                    <div class="review_content">
                                        <div class="review_name">{{ $row->product_name }}</div>
                                        <div class="review_rating_container">
                                            
                                            <div class="review_time">{{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</div>
                                        </div>
                                        <div class="review_text">
                                            <a href="{{ url('product/details/' . $row->id) }}" class="btn btn-block btn-info" style="margin-top: 43px;" style="bg-color: #007bff; color: #fff;">View</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                         

                        </div>
                        <div class="reviews_dots"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recently Viewed -->

    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Best Rated</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">

                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">

                           
                            <!-- Recently Viewed Item -->
                            @foreach ($best_rated as $row)
                            <div class="owl-item">
                                <div
                                    class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image"><img src="{{ asset($row->image_one) }}"
                                            alt=""></div>
                                    <div class="viewed_content text-center">
                                        <div class="viewed_price">
                                            <div class="product_price discount">
                                                @if ($row->discount_price == '')
                                                    &#8377;{{ $row->selling_price }}
                                                @else
                                                    &#8377;{{ $row->discount_price }}<span>&#8377;{{ $row->selling_price }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="viewed_name"><a href="{{ url('product/details/' . $row->id) }}"
                                            class="text-dark">{{ $row->product_name }}</a></div>
                                    </div>
                                    <ul class="item_marks">
                                        @if ($row->product_quantity <= 0)
                                                        <li class="item_mark item_discount" style="width: 172%;">OUT OF STOCK</li>
                                                    @else
                                                        @if ($row->discount_price == '')
                                                            <li class="item_mark item_discount"
                                                                style="background: #0e8ce4;">
                                                                New</li>
                                                        @else
                                                            <li class="item_mark item_discount">
                                                                @php
                                                                    $amount = $row->selling_price - $row->discount_price;
                                                                    $discount = ($amount / $row->selling_price) * 100;
                                                                    
                                                                @endphp
                                                                {{ intval($discount) }}%
                                                            </li>
                                                        @endif

                                                    @endif
                                        
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Brands -->

    <div class="brands">
        <div class="container">
            <h3>Brands</h3>
           
            <hr>
            <br>
            <div class="row">
                <div class="col">
                    <div class="brands_slider_container">

                        <!-- Brands Slider -->

                        <div class="owl-carousel owl-theme brands_slider">
                            @php
                                $brands = DB::table('brands')->get();
                            @endphp
                            @foreach ($brands as $row)
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center"><img
                                        src="{{ asset($row->brand_logo) }}" alt=""></div>
                            </div>
                            @endforeach
                           
                           

                        </div>

                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                    </div>
                </div>
            </div>
        </div>
    </div>

   




    <!-- Modal -->
    <div class="modal fade" id="cartmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="cartmodalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cartmodalLabel">Product Quick View</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="border: none;background: white;"><i class="fas fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="col-md-4">
                            <div class="card">

                                <img src="" alt="" id="pimage" class="text-center">
                                <div class="card-body">
                                    <h5 class="card-title text-center" id="pname"> </h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <ul class="list-group">
                                <li class="list-group-item">Product Code : <small id="pcode"></small></li>
                                <li class="list-group-item">Category : <span id="pcat"></span></li>
                                <li class="list-group-item">Subcategory : <span id="psub"></span></li>
                                <li class="list-group-item">Brand : <span id="pbrand"></span></li>
                                <li class="list-group-item">Stock : <span class="badge"
                                        style="background: green; color: white;">Available</span></li>
                            </ul>
                        </div>

                        <div class="col-md-4">
                            <form action="{{ route('insert.into.cart') }}" method="POST">
                                @csrf
                                <div class="form-group">

                                    <input type="hidden" name="product_id" id="product_id">

                                    <label for="exampleInputcolor">Color</label>
                                    <select name="color" id="color" class="form-control"
                                        style="min-width: 220px; max-width: 225px;">


                                    </select>

                                    <label for="exampleInputcolor">Size</label>
                                    <select name="size" id="size" class="form-control"
                                        style="min-width: 220px; max-width: 225px;">

                                    </select>

                                    <label for="exampleInputcolor">Quantity</label>
                                    <select name="qty" id="qty" class="form-control"
                                        style="min-width: 220px; max-width: 225px;">

                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary" style="float: right;">Add to Cart</button>
                            </form>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>


    {{-- PRODUCT QUICK VIEW --}}
    <script type="text/javascript">
        function productview(id) {

            $.ajax({
                url: "{{ url('/cart/product/view/') }}/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {

                    $('#pcode').text(data.product.product_code);
                    $('#pcat').text(data.product.category_name);
                    $('#psub').text(data.product.subcategory_name);
                    $('#pbrand').text(data.product.brand_name);
                    $('#pname').text(data.product.product_name);
                    $('#pimage').attr('src', data.product.image_one);
                    $('#product_id').val(data.product.id);

                    var X = $('select[name="color"]').empty();
                    $.each(data.product_color, function(key, value) {
                        $('select[name="color"]').append('<option value="' + value + '">' + value +
                            '</option>');
                    });

                    var Y = $('select[name="size"]').empty();
                    $.each(data.product_size, function(key, value) {
                        $('select[name="size"]').append('<option value="' + value + '">' + value +
                            '</option>');
                    });

                    var Z = $('select[name="qty"]').empty();
                    for (var i = 1; i <= data.product.product_quantity; i++) {

                        if (i <= 10) {
                            $('select[name="qty"]').append('<option value="' + i + '">' + i + '</option>');
                        }
                    }

                }
            })
        }

    </script>


    {{-- Add to wishlist --}}

    <script type="text/javascript">
        $(document).ready(function() {
            $('.addwishlist').on('click', function() {
                var id = $(this).data('id');
                if (id) {
                    $.ajax({
                        url: " {{ url('add/wishlist/') }}/" + id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {

                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            })

                            if ($.isEmptyObject(data.error)) {
                                var x = parseInt($(".wishlist_count")[0].innerText)
                                x += 1;
                                $(".wishlist_count")[0].innerText = x.toString();
                                Toast.fire({
                                    icon: 'success',
                                    title: data.success
                                })
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: data.error
                                })
                            }


                        },
                    });

                } else {
                    alert('danger');
                }
            });

        });

    </script>






<script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js') }}"></script>

@endsection
