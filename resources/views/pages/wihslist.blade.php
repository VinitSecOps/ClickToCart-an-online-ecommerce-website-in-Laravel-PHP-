@extends('layouts.app')
@section('content')
@include('layouts.menubar')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_responsive.css') }}">


    <!-- Cart -->

    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart_container">
                        <div class="cart_title">Your Wishlist <a href="{{ url('/remove/all/wishlist') }}" class="btn btn-warning" style="float: right;margin-right: 5px;
                            margin-top: 40px;
                        ">Clear all</a></div>
                        <div class="cart_items">
                            
                            <ul class="cart_list">
                                @foreach ($products as $row)


                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image"><img src="{{ asset($row->image_one) }}" alt="">
                                        </div>
                                        
                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col col-2">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ $row->product_name }}</div>
                                            </div>
                                            <div class="cart_item_color cart_info_col col-3">
                                                <div class="cart_item_title">Color</div>
                                                <div class="cart_item_text">{{ $row->product_color }}
                                                </div>
                                            </div>
                                            <div class="cart_item_color cart_info_col col-2">
                                                <div class="cart_item_title">Size</div>
                                                <div class="cart_item_text">{{ $row->product_size }}</div>
                                            </div>

                                           
                                           
                                          
                                            <div class="cart_item_total cart_info_col ">
                                                <div class="cart_item_title">Action</div>
                                                <div class="cart_item_text">
                                                    <a href="{{ url('remove/wishlist/' . $row->id) }}" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                    &nbsp;&nbsp;
                                                    <a href="{{ url('product/details/' . $row->id) }}" class="btn btn-success btn-sm">
                                                        <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                     
                       
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/frontend/js/cart_custom.js') }}"></script>


@endsection
