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
                        <div class="cart_title">Shopping Cart</div>
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
                                                <div class="qty cart_item_text">
                                                    <form action="{{ route('update.cart') }}" method="POST">
                                                        @csrf
                                                        @php
                                                            $product = DB::table('products')->where('id',$row->id)->select('products.product_quantity')->first();
                                                            if ($product->product_quantity > 10) {
                                                                $product->product_quantity = 10;
                                                            }
                                                        @endphp



                                                        <input type="number" class="text-center" name="qty" value="{{ $row->qty }}"
                                                            style="width: 50px;" max="{{ $product->product_quantity }}" min="1">
                                                        <input type="hidden" name="product_id" value="{{ $row->rowId }}">
                                                        <button type="submit" class="btn btn-success btn-sm"
                                                            title="Update"><i class="fas fa-check"></i></button>
                                                    </form>

                                                </div>
                                            </div>
                                            <div class="cart_item_price cart_info_col ">
                                                <div class="cart_item_title">Price</div>
                                                <div class="cart_item_text">&#8377;{{ $row->price }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col ">
                                                <div class="cart_item_title">Total</div>
                                                <div class="cart_item_text">&#8377;{{ $row->price * $row->qty }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col ">
                                                <div class="cart_item_title">Action</div>
                                                <div class="cart_item_text"><a href="{{ url('remove/cart/' . $row->rowId) }}"
                                                    class="btn btn-danger btn-sm"><i class="fas fa-times"></i></a></div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Order Total -->
                        <div class="order_total">
                            <div class="order_total_content text-md-right">
                                <div class="order_total_title">Order Total:</div>
                                <div class="order_total_amount">&#8377;{{ Cart::total() }}</div>
                            </div>
                        </div>

                        <div class="cart_buttons">
                            @if (Cart::content()->isEmpty())
                            
                            @else
                            <a href="{{ route('cart.destroy') }}"  class="button cart_button_clear">Cancel All</a> 
                               
                            @endif
                           
                            <a href="{{ route('user.checkout') }}"  class="button cart_button_checkout">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('public/frontend/js/cart_custom.js') }}"></script>


@endsection
