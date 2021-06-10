@extends('layouts.app')
@section('content')
@include('layouts.menubar')

@php
    $setting =  DB::table('settings')->first();
    $charge = $setting->shipping_charge;
    $VAT = $setting->vat;
@endphp
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/cart_responsive.css') }}">


    <!-- Cart -->

    <div class="cart_section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart_container">
                        <div class="cart_title">Checkout</div>
                        <div class="cart_items">

                            <ul class="cart_list">
                                @foreach ($cart as $row)


                                    <li class="cart_item clearfix">
                                        <div class="cart_item_image"><img src="{{ asset($row->options->image) }}" alt="">
                                        </div>

                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col col-2">
                                                <div class="cart_item_title">Name</div>
                                                <div class="cart_item_text">{{ $row->name }}</div>
                                            </div>
                                            <div class="cart_item_color cart_info_col col-1">
                                                <div class="cart_item_title">Color</div>
                                                <div class="cart_item_text"><span
                                                        style="background-color: {{ $row->options->color }};"></span>{{ $row->options->color }}
                                                </div>
                                            </div>
                                            <div class="cart_item_color cart_info_col col-1">
                                                <div class="cart_item_title">Size</div>
                                                <div class="cart_item_text">{{ $row->options->size }}</div>
                                            </div>

                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title">Quantity</div>
                                                <div class="cart_item_text">{{ $row->qty }}</div>
                                            </div>
                                            
                                            <div class="cart_item_price cart_info_col ">
                                                <div class="cart_item_title">Price</div>
                                                <div class="cart_item_text">&#8377;{{ $row->price }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col ">
                                                <div class="cart_item_title">Total</div>
                                                <div class="cart_item_text">&#8377;{{ $row->price * $row->qty }}</div>
                                            </div>
                                            
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <br>
                        <!-- Order Total -->
                        <div class="col-lg-8" style="padding: 15px;float: left;">
                            @if (Session::has('coupon'))
                                
                            
                            @else
                            <form action="{{ route('apply.coupon') }}" method="POST">
                                @csrf
                                <div class="form-group col-4">
                                    <i class="fa fa-tag" aria-hidden="true"></i> <label style="font-weight: 500; margin-left: 5px;">Apply Coupon</label>
                                    <input type="text" name="coupon" class="form-control" id="" required
                                        placeholder="Enter Coupon Code" onkeyup="this.value = this.value.toUpperCase();"><br>
                                        <button type="submit" class="btn btn-danger">Apply</button>
                                </div>
                                
                            </form>
                            @endif
                        </div>

                        <ul class="list-group col-lg-4" style="float: right;">
                            @if (Session::has('coupon'))
                                <li class="list-group-item">Subtotal : <span style="float: right;">&#8377;{{ Session::get('coupon')['balance'] }}</span></li>
                                <li class="list-group-item">Coupon : ({{ Session::get('coupon')['name'] }}) <a href="{{ route('remove.coupon') }}" class="text text-danger"><i class="fas fa-times"></i></a> <span style="float: right;">{{ Session::get('coupon')['discount'] }}%</span></li>
                            @else
                                <li class="list-group-item">Subtotal : <span style="float: right;">&#8377;{{ Cart::subtotal() }}</span></li>
                            @endif
                            
                            <li class="list-group-item">Shipping Charges : <span style="float: right;">&#8377;{{ $charge}}</span></li>
                            <li class="list-group-item">VAT : <span style="float: right;">&#8377;{{ $VAT }}</span></li>

                            @if (Session::has('coupon'))
                            <li class="list-group-item"><h3>Total : <span style="float: right;">&#8377;{{ Session::get('coupon')['balance'] + $charge + $VAT }}</span></h3></li>
                            @else
                            <li class="list-group-item"><h3>Total : <span style="float: right;">&#8377;{{ Cart::subtotal() + $charge + $VAT }}</span></h3></li>
                            @endif
                            
                            <a href="{{ route('payment.step') }}" class="button cart_button_checkout"><span style="float: right;">Final Step <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span></a>

                        </ul>
                    </div>
                </div>
            </div>


            <div class="cart_buttons">
            </div>
        </div>
    </div>

    <script src="{{ asset('public/frontend/js/cart_custom.js') }}"></script>


@endsection
