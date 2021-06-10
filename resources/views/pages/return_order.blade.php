@extends('layouts.app')
@section('content')

    @php

    $ship_address = '';

    @endphp

    <style>
        .modal-lg {
            max-width: 80% !important;
        }

    </style>

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-9 card">
                    <br>
                    <h3 class="text-center">Return order request </h3>
                    <br>



                    <div class="col-lg-12">
                        @foreach ($orders as $row)
                            <div class="card">
                                <div class="card-header">
                                    <table class="col-lg-12">
                                        <tr>
                                            <th>
                                                @if ($row->status == 3)
                                                    DELIVERED
                                                @else
                                                    ORDER PLACED
                                                @endif

                                            </th>
                                            <th>TOTAL</th>
                                            <th>SHIP TO</th>
                                            <th rowspan="2">

                                                @if ($row->return_order == 1 || $row->return_order == 2)
                                                @else
                                                    <i class="fa fa-location-arrow" aria-hidden="true"></i>
                                                    <a href="{{ url('order/tracking/' . $row->status_code) }}"
                                                        class="text-dark"> Track</a>
                                                @endif
                                            </th>
                                            <th rowspan="2">
                                                @if ($row->return_order == 0)
                                                    <a href="{{ url('request/return/' . $row->id) }}"
                                                        class="btn btn-sm btn-danger" id="return">Return</a>
                                                @elseif ($row->return_order == 1)
                                                    <a href="javascript:void(0)"
                                                        class="badge badge-sm badge-warning">Pending return request</a>
                                                @elseif ($row->return_order == 2)
                                                    <a href="javascript:void(0)" class="badge badge-sm badge-success">Order
                                                        returned</a>
                                                @endif
                                            </th>
                                            <th style="float: right;">Order ID# {{ $row->stripe_order_id }}
                                            </th>
                                        </tr>
                                        <tr>
                                            <td>
                                                @if ($row->status == 3)
                                                    {{ \Carbon\Carbon::parse($row->updated_at)->format('d F Y') }}
                                                @else
                                                    {{ \Carbon\Carbon::parse($row->date)->format('d F Y') }}
                                                @endif



                                            </td>
                                            <td>&#8377;{{ $row->total }}</td>
                                            @php
                                                $shipping = DB::table('shipping')
                                                    ->where('order_id', $row->id)
                                                    ->first();
                                                $ship_address = $shipping->ship_address;
                                            @endphp
                                            <td>
                                                <a href="javascript:void(0)"
                                                    data-toggle="popover">{{ $shipping->ship_name }}</a>
                                                <i class="fas fa-caret-down"></i>

                                            </td>

                                            <td style="float: right;">

                                                @if ($row->status == 3)
                                                    <a href="" id="{{ $row->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#ordermodal" onclick="orderview(this.id)">View order
                                                        deatils</a> &nbsp;<small> | </small>&nbsp;
                                                    <a href="{{ url('invoice/' . $row->id) }}" target="_blank">Invoice</a>
                                                @else
                                                    <a href="" id="{{ $row->id }}" data-bs-toggle="modal"
                                                        data-bs-target="#ordermodal" onclick="orderview(this.id)">View order
                                                        deatils</a>
                                                @endif

                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                @php
                                    $details = DB::table('orders_details')
                                        ->join('products', 'orders_details.product_id', 'products.id')
                                        ->select('orders_details.*', 'products.image_one')
                                        ->where('order_id', $row->id)
                                        ->get();
                                @endphp
                                @foreach ($details as $item)
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <img src="{{ asset($item->image_one) }}" alt="product_image"
                                                    style="height: 80px; width: 100px;">
                                            </div>
                                            <div class="col-lg-3">
                                                <a href="{{ url('product/details/' . $item->product_id) }}"
                                                    class="text text-info">{{ $item->product_name }}</a>
                                            </div>
                                            <div class="col-lg-6">
                                                <table class="col-lg-12">
                                                    <tr>
                                                        <th>COLOR</th>
                                                        <th>SIZE</th>
                                                        <th>QTY</th>

                                                    </tr>

                                                    <tr>
                                                        <td>{{ $item->color }}</td>
                                                        <td>{{ $item->size }}</td>
                                                        <td>{{ $item->quantity }}</td>

                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                            <br>
                        @endforeach

                    </div>

                    <div class="card-body">
                        {{ $orders->links() }}
                    </div>

                </div>


                {{-- USER PROFILE --}}
                <div class="col-3">
                    <div class="card">
                        <img src="{{ (!empty(Auth::user()->avatar)) ? asset(Auth::user()->avatar) : url('public/media/user/no_image.jpg') }}" class="card-img-top rounded-circle"
                            style="height: 90px; width:90px; margin-left:32%;margin-top:10px;">
                        <div class="card-body">
                            <h5 class="text-center">{{ Auth::user()->name }}</h5>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="{{ url('profile') }}">Edit profile</a></li>
                            <li class="list-group-item"><a href="{{ route('password.change') }}">Change Password</a></li>
                    <li class="list-group-item"><a href="{{ url('home') }}">Your orders</a></li>

                            <li class="list-group-item"><a href="{{ route('success.orderlist') }}">Return orders</a></li>
                        <div class="card-body">
                            <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Order Details Modal -->

    <div class="modal fade" id="ordermodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="ordermodalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ordermodalLabel">Order# <span style="float: right;"
                            id="order_payment_id"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        style="border: none;background: white;"><i class="fas fa-times fa-lg"></i></button>
                </div>
                <div class="modal-body">
                    <div class="row">


                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header"><strong>Order</strong> details</div>

                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">Name : <span style="float: right;"
                                                id="order_name"></span></li>
                                        <li class="list-group-item">Phone : <span style="float: right;"
                                                id="order_phone"></span></li>
                                        <li class="list-group-item">Payment type : <span style="float: right;"
                                                id="order_payment_type" class="badge badge-dark"></span></li>
                                        <li class="list-group-item">Tracking ID : <span style="float: right;"
                                                id="order_id"></span></li>
                                        <li class="list-group-item">Total : <span style="float: right;"
                                                id="order_total"></span></li>
                                        <li class="list-group-item">Date : <span style="float: right;"
                                                id="order_date"></span></li>
                                        <li class="list-group-item">Month / Year : <span style="float: right;"
                                                id="order_month_year"></span></li>
                                        <li class="list-group-item">Return request : <span style="float: right;"
                                                id="order_return_request"></span></li>
                                    </ul>
                                </div>


                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header"><strong>Shipping</strong> details</div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        <li class="list-group-item">Name : <span style="float: right;"
                                                id="ship_name"></span></li>
                                        <li class="list-group-item">Phone : <span style="float: right;"
                                                id="ship_phone"></span></li>
                                        <li class="list-group-item">Email : <span style="float: right;"
                                                id="ship_email"></span></li>
                                        <li class="list-group-item">Address : <small style="float: right;" id="ship_address"
                                                class="col-lg-6 text-right"></small></li>
                                        <li class="list-group-item">Country : <span style="float: right;"
                                                id="ship_country"></span></li>
                                        <li class="list-group-item">State : <span style="float: right;"
                                                id="ship_state"></span></li>
                                        <li class="list-group-item">City : <span style="float: right;"
                                                id="ship_city"></span></li>
                                        <li class="list-group-item" id="status">Status : <span style="float: right;"
                                                id="order_status"></span></li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header text-center"><b>Product Details</b></div>
                            </div>
                            <div class="card-body">


                                <div class="table-wrapper">
                                    <table class="table display responsive nowrap">
                                        <thead>
                                            <tr>
                                                <!-- <th width="1%">Code</th> -->

                                                <th>Product Code</th>
                                                <th>Product Name</th>
                                                <th>Image</th>
                                                <th>Color</th>
                                                <th>size</th>
                                                <th>Quantity</th>
                                                <th>Unit Price</th>
                                                <th>Total</th>

                                            </tr>
                                        </thead>
                                        <tbody id="product_details">



                                        </tbody>
                                    </table>
                                </div><!-- table-wrapper -->
                            </div>
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        $('#ordermodal').appendTo('body');

    </script>



    {{-- PRODUCT QUICK VIEW --}}
    <script type="text/javascript">
        function orderview(id) {

            $.ajax({
                url: "{{ url('/user/order/view/') }}/" + id,
                type: "GET",
                dataType: "json",
                success: function(data) {

                    // order details
                    $('#order_name').text(data.order.name);
                    $('#order_phone').text('+91' + data.order.phone);
                    $('#order_payment_type').text(data.order.payment_type);
                    $('#order_id').text('#' + data.order.status_code);
                    $('#order_total').text('₹' + data.order.total);
                    $('#order_date').text(data.order.date);
                    $('#order_month_year').text(data.order.month + ', ' + data.order.year);

                    if (data.order.return_order == 0) {
                        $('#order_return_request').html('<span class="badge badge-warning">No request</span>');
                    } else if (data.order.return_order == 1) {
                        $('#order_return_request').html('<span class="badge badge-info">Pending</span>');
                    } else if (data.order.return_order == 2) {
                        $('#order_return_request').html('<span class="badge badge-success">Success</span>');
                        $('#status').empty();
                    }


                    if (data.order.status == 0) {
                        $('#order_status').html('<span class="badge badge-warning">Pending</span>');
                    } else if (data.order.status == 1) {
                        $('#order_status').html('<span class="badge badge-info">Payment Accept</span>');
                    } else if (data.order.status == 2) {
                        $('#order_status').html('<span class="badge badge-secondary">Progress</span>');
                    } else if (data.order.status == 3) {
                        $('#order_status').html('<span class="badge badge-success">Delivered</span>');
                    } else {
                        $('#order_status').html('<span class="badge badge-danger">Cancelled</span>');
                    }


                    // shipping details
                    $('#ship_name').text(data.shipping.ship_name);
                    $('#ship_phone').text('+91' + data.shipping.ship_phone);
                    $('#ship_email').text(data.shipping.ship_email);
                    $('#ship_address').text(data.shipping.ship_address);
                    $('#ship_country').text(data.shipping.ship_country);
                    $('#ship_state').text(data.shipping.ship_state);
                    $('#ship_city').text(data.shipping.ship_city);


                    // product details
                    $('#product_details').empty();
                    for (var i = 0; i < data.details.length; i++) {
                        $('#product_details').append(createTr(data.details[i]));
                    }

                    function createTr(value) {
                        return '<tr><td>' + value.product_code + '</td><td>' + value.product_name +
                            '</td><td><img src="http://localhost/ecommerce/' + value.image_one +
                            '" style="height:80px; width:100px;"></td><td>' + value.color + '</td><td>' + value
                            .size + '</td><td>' + value.quantity + '</td><td>&#8377;' + value.single_price +
                            '</td><td>&#8377;' + value.total_price + '</td></tr>'
                    }

                }
            })
        }

    </script>

    <script>
        $(document).ready(function() {
            $('[data-toggle="popover"]').popover({
                placement: 'bottom',
                content: '<?php echo $ship_address; ?>',
                trigger: 'hover'
            });
        });

    </script>



@endsection
