@extends('layouts.app')
@section('content')
@include('layouts.menubar')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/shop_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/shop_responsive.css') }}">

    <!-- Home -->

    <div class="home">
        <div class="home_background parallax-window" data-parallax="scroll" data-image-src="{{ asset('public/frontend/images/shop_background.jpg') }}">
        </div>
        <div class="home_overlay"></div>
        <div class="home_content d-flex flex-column align-items-center justify-content-center">
            <h2 class="home_title">Search for "{{ $item }}"</h2>
        </div>
    </div>

    <!-- Shop -->

    <div class="shop">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">

                    <!-- Shop Sidebar -->
                    <div class="shop_sidebar">
                        <div class="sidebar_section">
                            <div class="sidebar_title">Categories</div>
                            <ul class="sidebar_categories">
                                @php
                                    $categories = DB::table('categories')->get();
                                @endphp
                                @foreach ($categories as $row)
                                <li><a href="{{ url('allcategory/'.$row->id.'/name') }}">{{ $row->category_name }}</a></li>
                                @endforeach
                               
                                
                            </ul>
                        </div>

                        {{-- <div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							<div class="sidebar_subtitle">Price</div>
							<div class="filter_price">
                                <form class="form-inline" method="get" action="{{ Request::url() }}">
                                    @csrf
                                    <div class="form-group mb-1">
                                      <input type="text" class="form-control" name="min" placeholder="₹Min" size="3" maxlength="9"> 
                                    </div>
                                   
                                    <div class="form-group mx-sm-3 mb-1">
                                      <input type="text" class="form-control" name="max" placeholder="₹Max" size="3" maxlength="9">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary mb-1" size="2">Go</button>
                                  </form>
                               
							</div>
						</div> --}}
						<div class="sidebar_section">
							<div class="sidebar_subtitle color_subtitle">Color</div>
							<ul class="colors_list">
                                @php
                                    $colors = DB::table('colors')->inRandomOrder()->get();
                                @endphp


                                <ul class="colors_list">
                                    @foreach ($colors as $row)
                                        <li class="color">
                                            <a href="" style="background:{{ $row->color }};<?php if($row->color == "White" || $row->color == "Yellow") echo "border: solid 1px #e1e1e1;"; ?>" title="{{ $row->color }}"></a>
                                        </li>
                                    @endforeach
                                </ul>
							</ul>
						</div>
                      
                        
                        <div class="sidebar_section">
                            <div class="sidebar_subtitle brands_subtitle">Brands</div>
                            <ul class="brands_list">
                                @php
                                 $brands = DB::table('brands')->inRandomOrder()->limit(10)->get();
                                @endphp
                                @foreach ($brands as $row)
                               
                                     <li class="brand"><a href="#">{{ $row->brand_name }}</a></li>
                                @endforeach
                               
                               
                            </ul>
                        </div>
                    </div>

                </div>

                <div class="col-lg-9">

                    <!-- Shop Content -->

                    <div class="shop_content">
                        <div class="shop_bar clearfix">
                            <div class="shop_product_count"><span>{{ $products->total() }}</span> products found</div>
                            <div class="shop_sorting">
                                <span>Sort by:</span>
                                <ul>
                                    <li>
                                        <span class="sorting_text">
                                            @if (str_contains(url()->full(),"sort=name"))
                                            {{ "Name" }}
                                        @elseif (str_contains(url()->full(),"sort=low"))
                                            {{ "Low to high" }}
                                        @elseif (str_contains(url()->full(),"sort=high"))
                                            {{ "High to low" }}
                                        @endif<i class="fas fa-chevron-down"></span></i>
                                        <ul>
                                            <a href="{{ str_replace("sort=","sort=name",substr(url()->full(), 0, strpos(url()->full(), "sort=")+5)) }}"><li class="shop_sorting_button"
                                                data-isotope-option='{ "sortBy": "original-order" }'>Name</li></a>
                                            <a href="{{ str_replace("sort=","sort=low",substr(url()->full(), 0, strpos(url()->full(), "sort=")+5)) }}"><li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>Low to high</li></a>
                                            <a href="{{ str_replace("sort=","sort=high",substr(url()->full(), 0, strpos(url()->full(), "sort=")+5)) }}"><li class="shop_sorting_button" data-isotope-option='{ "sortBy": "price" }'>
                                                High to low</li></a>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product_grid row">
                            <div class="product_grid_border"></div>


                            @foreach ($products as $row)
                                <!-- Product Item -->
                                <div class="product_item is_new">
                                    <div class="product_border"></div>
                                    <div class="product_image d-flex flex-column align-items-center justify-content-center">
                                        <img src="{{ asset($row->image_one) }}" alt=""
                                            style="height: 100px; width: 100px;">
                                    </div>
                                    <div class="product_content">
                                        <div class="product_price">
                                            @if ($row->discount_price == '')
                                                <div class="product_price discount">
                                                    &#8377;{{ $row->selling_price }}</div>
                                            @else
                                                <div class="product_price discount">
                                                    &#8377;{{ $row->discount_price }}<span>&#8377;{{ $row->selling_price }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product_name">
                                            <div><a href="{{ url('product/details/' . $row->id) }}" tabindex="0">{{ $row->product_name }}</a></div>
                                        </div>
                                    </div>
                                    <ul class="product_marks">
                                        @if ($row->discount_price == '')
                                            <li class="product_mark product_new" style="background: #0e8ce4;">
                                                New</li>
                                        @else
                                            <li class="product_mark product_new" style="background: #df3b3b;">
                                                @php
                                                    $amount = $row->selling_price - $row->discount_price;
                                                    $discount = ($amount / $row->selling_price) * 100;
                                                    
                                                @endphp
                                                {{ intval($discount) }}%
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            @endforeach


                        </div>

                        <!-- Shop Page Navigation -->

                        @if ($products->total() > 15)
                        <div class="shop_page_nav d-flex flex-row">
                            <ul class="page_nav d-flex flex-row">
                                {{ $products->links() }}
                            </ul>
                        </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>
<script src="{{ asset('public/frontend/plugins/parallax-js-master/parallax.min.js') }}"></script>

@endsection
