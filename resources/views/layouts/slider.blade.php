<!-- Banner -->
@php

$main_slider = DB::table('products')
->join('brands','products.brand_id','brands.id')
->select('products.*','brands.brand_name')
->where('status',1)->where('main_slider',1)->orderBy('updated_at','DESC')->first();
@endphp
<div class="banner">
    <div class="banner_background" style="background-image:url({{ asset('public/frontend/images/banner_background.jpg')}})"></div>
    <div class="container fill_height">
        <div class="row fill_height">
            <div class="banner_product_image"><img src="{{ asset($main_slider->image_one)}}" alt="" height="400px" width="500px"></div>
            <div class="col-lg-5 offset-lg-4 fill_height">
                <div class="banner_content">
                    <h1 class="banner_text">{{ $main_slider->product_name }}</h1>
                    <div class="banner_price">
                        @if($main_slider->discount_price == "")
                        &#8377;{{ $main_slider->selling_price }}
                        @else
                        <span>&#8377;{{ $main_slider->selling_price }}</span>&#8377;{{ $main_slider->discount_price }}
                        @endif
                    </div>
                    <div class="banner_product_name">{{ $main_slider->brand_name }}</div>
                    <div class="button banner_button"><a href="{{ url('product/details/' . $main_slider->id) }}">Shop Now</a></div>
                </div>
            </div>
        </div>
    </div>
</div>