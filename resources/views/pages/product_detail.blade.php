@extends('layouts.app')
@section('content')
    @include('layouts.menubar')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/product_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/product_responsive.css') }}">
    <!-- Single Product -->

    <div class="single_product">
        <div class="container">
            <div class="row">

                <!-- Images -->
                <div class="col-lg-2 order-lg-1 order-2">
                    <ul class="image_list">
                        <li data-image="{{ asset($product->image_one) }}"><img src="{{ asset($product->image_one) }}"
                                alt=""></li>
                        <li data-image="{{ asset($product->image_two) }}"><img src="{{ asset($product->image_two) }}"
                                alt=""></li>
                        <li data-image="{{ asset($product->image_three) }}"><img
                                src="{{ asset($product->image_three) }}" alt=""></li>
                    </ul>
                </div>

                <!-- Selected Image -->
                <div class="col-lg-5 order-lg-2 order-1">
                    <div class="image_selected"><img src="{{ asset($product->image_one) }}" alt=""></div>
                </div>

                <!-- Description -->
                <div class="col-lg-5 order-3">
                    <div class="product_description">
                         
                        <div class="product_category">{{ $product->category_name }} > {{ $product->subcategory_name }}
                        </div>
                        <div class="product_name">{{ $product->product_name }}</div>
                        <div class="product_text">
                            <p>{!! str_limit($product->product_details, $limit = 600) !!}</p>
                        </div>
                        
                        <div class="order_info d-flex flex-row">
                            <form action="{{ url('cart/product/add/' . $product->id) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4">
                                        <label for="exampleFormControlSelect1">Colors</label>
                                        <select name="color" id="exampleFormControlSelect1" class="form-control input-lg"
                                            style="min-width: 125px; max-width: 225px;">
                                            @foreach ($product_color as $color)
                                                <option value="{{ $color }}">{{ $color }}</option>
                                            @endforeach


                                        </select>
                                    </div>


                                    <div class="col-lg-4">
                                        <label for="exampleFormControlSelect1">Sizes</label>
                                        <select name="size" id="exampleFormControlSelect1" class="form-control input-lg"
                                            style="min-width: 125px; max-width: 225px;">
                                            @foreach ($product_size as $size)
                                                <option value="{{ $size }}">{{ $size }}</option>
                                            @endforeach

                                        </select>
                                    </div>


                                    <div class="col-lg-4">
                                        <label for="exampleFormControlSelect1">Quantity</label>

                                        <select name="qty" id="exampleFormControlSelect1" class="form-control input-lg"
                                            style="min-width: 125px; max-width: 225px;">
                                            @for ($i = 1; $i <= $product->product_quantity; $i++)


                                                @if ($i <= 10)
                                                    <option value="{{ $i }}">{{ $i }}</option>

                                                @endif
                                            @endfor

                                        </select>
                                    </div>
                                </div>



                                @if ($product->discount_price == '')
                                    <div class="product_price"> &#8377;{{ $product->selling_price }}<span></span></div>
                                @else
                                    <div class="product_price">
                                        &#8377;{{ $product->discount_price }}<span>&#8377;{{ $product->selling_price }}</span>
                                    </div>
                                @endif
                                <div class="button_container">
                                    <button type="submit" class="button cart_button">Add to
                                        Cart</button>
                                    <div class="product_fav"><i class="fas fa-heart"></i></div>
                                </div>

                                <br>
                                <hr>
                                <h5>Share this product</h5>

                                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                                <div class="addthis_inline_share_toolbox_8vjr"></div>
              
            


                            </form>
                        </div>
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
                        <h3 class="viewed_title">More about Product...</h3>

                    </div>

                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active text-info" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                aria-selected="true">Product Details</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-info" id="profile-tab" data-bs-toggle="tab"
                                data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                                aria-selected="false">Video Link</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link text-info" id="contact-tab" data-bs-toggle="tab"
                                data-bs-target="#contact" type="button" role="tab" aria-controls="contact"
                                aria-selected="false">Product
                                Review</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <br><br>{!! $product->product_details !!}
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab"><br><br>
                            <iframe width="1000" height="500" src="{{ $product->video_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            <div class="fb-comments" data-href="{{ Request::url() }}" data-width="" data-numposts="5">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0"
        nonce="IC2B4zt2"></script>


    <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-6095459ccfd163e1"></script>



@endsection
