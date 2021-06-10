@extends('layouts.app')

@section('content')
    @include('layouts.menubar')

    @php
    $setting = DB::table('settings')->first();
    $charge = $setting->shipping_charge;
    $VAT = $setting->vat;
    @endphp

    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_responsive.css') }}">


    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-7" style="border: solid white; padding: 20px; border-radius: 25px;width: 250px;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                    ">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Cart Products</div>
                        <div class="cart_items">

                            <ul class="cart_list">
                                @foreach ($cart as $row)


                                    <li class="cart_item clearfix">


                                        <div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
                                            <div class="cart_item_name cart_info_col col-2">
                                                <div class="cart_item_text"><img src="{{ asset($row->options->image) }}"
                                                        alt="" style="height: 70px; width: 70px;"></div>
                                            </div>
                                            <div class="cart_item_name cart_info_col col-2">
                                                <div class="cart_item_title"><b>Name</b></div>
                                                <div class="cart_item_text">{{ $row->name }}</div>
                                            </div>
                                            <div class="cart_item_color cart_info_col col-1">
                                                <div class="cart_item_title"><b>Color</b></div>
                                                <div class="cart_item_text"><span
                                                        style="background-color: {{ $row->options->color }};"></span>{{ $row->options->color }}
                                                </div>
                                            </div>
                                            <div class="cart_item_color cart_info_col col-1">
                                                <div class="cart_item_title"><b>Size</b></div>
                                                <div class="cart_item_text">{{ $row->options->size }}</div>
                                            </div>

                                            <div class="cart_item_quantity cart_info_col">
                                                <div class="cart_item_title"><b>Quantity</b></div>
                                                <div class="cart_item_text">{{ $row->qty }}</div>
                                            </div>

                                            <div class="cart_item_price cart_info_col ">
                                                <div class="cart_item_title"><b>Price</b></div>
                                                <div class="cart_item_text">&#8377;{{ $row->price }}</div>
                                            </div>
                                            <div class="cart_item_total cart_info_col ">
                                                <div class="cart_item_title"><b>Total</b></div>
                                                <div class="cart_item_text">&#8377;{{ $row->price * $row->qty }}</div>
                                            </div>

                                        </div>
                                    </li>
                                    <hr>
                                @endforeach
                            </ul>
                        </div>

                        <ul class="list-group col-lg-6" style="float: right;">
                            @if (Session::has('coupon'))
                                <li class="list-group-item">Subtotal : <span
                                        style="float: right;">&#8377;{{ Session::get('coupon')['balance'] }}</span></li>
                                <li class="list-group-item">Coupon : ({{ Session::get('coupon')['name'] }}) <a
                                        href="{{ route('remove.coupon') }}" class="text text-danger"><i
                                            class="fas fa-times"></i></a> <span
                                        style="float: right;">{{ Session::get('coupon')['discount'] }}%</span></li>
                            @else
                                <li class="list-group-item">Subtotal : <span
                                        style="float: right;">&#8377;{{ Cart::subtotal() }}</span></li>
                            @endif

                            <li class="list-group-item">Shipping Charges : <span
                                    style="float: right;">&#8377;{{ $charge }}</span></li>
                            <li class="list-group-item">VAT : <span style="float: right;">&#8377;{{ $VAT }}</span>
                            </li>

                            @if (Session::has('coupon'))
                                <li class="list-group-item">
                                    <b> Total : <span
                                            style="float: right;">&#8377;{{ Session::get('coupon')['balance'] + $charge + $VAT }}</span>
                                    </b>
                                </li>
                            @else
                                <li class="list-group-item">
                                    <b> Total : <span
                                            style="float: right;">&#8377;{{ Cart::subtotal() + $charge + $VAT }}</span>
                                    </b>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>

                <div class="col-lg-1"></div>

                <div class="col-lg-4 " style="border: solid white; padding: 20px; border-radius: 25px; width: 250px;
                    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
                    ">
                    <div class="contact_form_container">
                        <div class="contact_form_title text-center">Shipping Address</div>
                        <form action="{{ route('payemnt.process') }}" method="POST" id="contact_form">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Full Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                    aria-describedby="emailHelp" required placeholder="Enter Your Name ">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}" name="phone" aria-describedby="emailHelp" required
                                    placeholder="Enter Your Phone Number">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" name="email" aria-describedby="emailHelp" required
                                    placeholder="Enter Your Email Address">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Address</label>
                                <textarea class="form-control @error('address') is-invalid @enderror" name="address"
                                    aria-describedby="emailHelp"  placeholder="Enter Your Address"></textarea>
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Country</label>
                                <select id="country-dd" class="form-control" style="min-width: 335px; max-width: 225px;" name="country">
                                    <option value="">Select Country</option>
                                    @foreach ($data['countries'] as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="exampleInputEmail1" class="form-label">State</label>
                                <select id="state-dd" class="form-control" style="min-width: 335px; max-width: 225px;" name="state">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1" class="form-label" >City</label>
                                <select id="city-dd" class="form-control" style="min-width: 335px; max-width: 225px;" name="city">
                                </select>
                            </div>

                            <div class="contact_form_title text-center">Payment By</div>
                            <div class="form-group">
                                <ul class="logos_list">
                                    <li>
                                        <input type="radio" name="payment" value="stripe" required>
                                        <img src="{{ asset('public/frontend/images/mastercard.png') }}" alt=""
                                            style="width: 150px; heigth: 60px;" >
                                    </li>
                                   
                                </ul>
                            </div>

                            <div class="contact_form_button text-center">

                                <button type="submit" class="btn btn-info">Pay Now</button><br><br>
                            </div>
                        </form>



                    </div>
                </div>

            </div>
        </div>
        <div class="panel"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#country-dd').on('change', function() {
                var idCountry = this.value;
                $("#state-dd").html('');
                $.ajax({
                    url: "{{ url('api/fetch-states') }}",
                    type: "POST",
                    data: {
                        country_id: idCountry,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#state-dd').html('<option value="">Select State</option>');
                        $.each(result.states, function(key, value) {
                            $("#state-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                        $('#city-dd').html('<option value="">Select City</option>');
                    }
                });
            });
            $('#state-dd').on('change', function() {
                var idState = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url: "{{ url('api/fetch-cities') }}",
                    type: "POST",
                    data: {
                        state_id: idState,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(res) {
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(res.cities, function(key, value) {
                            $("#city-dd").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });
        });

    </script>
@endsection
