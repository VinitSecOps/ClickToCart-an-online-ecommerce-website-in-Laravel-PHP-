@extends('admin.admin_layouts')

@section('admin_content')

    <div class="sl-mainpanel">

        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        
            @if ($order->status == 0)
                <a class="breadcrumb-item" href="{{ url('admin/pending/order') }}">Order</a>
            @elseif ($order->status == 1)
                <a class="breadcrumb-item" href="{{ url('admin/accept/payment') }}">Order</a>
            @elseif ($order->status == 2)
                <a class="breadcrumb-item" href="{{ url('admin/process/payment') }}">Order</a>
            @elseif ($order->status == 3)
                <a class="breadcrumb-item" href="{{ url('admin/success/payment') }}">Order</a>
            @else
                <a class="breadcrumb-item" href="{{ url('admin/cancel/order') }}">Order</a>
            @endif

            <span class="breadcrumb-item active">Order Details</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Order Details</h5>

            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Orders</strong> Details
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>Name :</th>
                                        <th>{{ $order->name }}</th>
                                    </tr>
                                    <tr>
                                        <th>Phone :</th>
                                        <th>+91{{ $order->phone }}</th>
                                    </tr>
                                    <tr>
                                        <th>Payment type :</th>
                                        <th><span class="badge badge-dark">{{ $order->payment_type }}</span></th>
                                    </tr>
                                    <tr>
                                        <th>Payment ID:</th>
                                        <th>{{ $order->payment_id }}</th>
                                    </tr>
                                    <tr>
                                        <th>Total:</th>
                                        <th>&#8377;{{ $order->total }}</th>
                                    </tr>
                                    <tr>
                                        <th>Date:</th>
                                        <th>{{ $order->date }}</th>
                                    </tr>
                                    <tr>
                                        <th>Month / Year:</th>
                                        <th>{{ $order->month }}, {{ $order->year }} </th>
                                    </tr>


                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>Shipping</strong> Details
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <th>Name :</th>
                                        <th>{{ $shipping->ship_name }}</th>
                                    </tr>
                                    <tr>
                                        <th>Phone :</th>
                                        <th>+91{{ $shipping->ship_phone }}</th>
                                    </tr>
                                    <tr>
                                        <th>Email :</th>
                                        <th>{{ $shipping->ship_email }}</th>
                                    </tr>
                                    <tr>
                                        <th>Address:</th>
                                        <th>{{ $shipping->ship_address }}</th>
                                    </tr>
                                    <tr>
                                        <th>Country:</th>
                                        <th>{{ $shipping->ship_country }}</th>
                                    </tr>
                                    <tr>
                                        <th>State:</th>
                                        <th>{{ $shipping->ship_state }}</th>
                                    </tr>
                                    <tr>
                                        <th>City:</th>
                                        <th>{{ $shipping->ship_city }}</th>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <th>
                                            @if ($order->status == 0)
                                                <span class="badge badge-warning">Pending</span>
                                            @elseif ($order->status == 1)
                                                <span class="badge badge-info">Payment Accept</span>
                                            @elseif ($order->status == 2)
                                                <span class="badge badge-secondary">Progress</span>
                                            @elseif ($order->status == 3)
                                                <span class="badge badge-success">Delivered</span>
                                            @else
                                                <span class="badge badge-danger">Cancelled</span>
                                            @endif
                                        </th>
                                    </tr>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="card pd-20 pd-sm-40 col-lg-12">
                        <h6 class="card-body-title">Product Details
                        </h6>


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
                                <tbody>
                                    @foreach ($details as $row)
                                        <tr>
                                            <td>{{ $row->product_code }}</td>
                                            <td>{{ $row->product_name }}</td>
                                            <td><img src="{{ URL::to($row->image_one) }}" height="80px" width="100px">
                                            </td>
                                            <td>{{ $row->color }}</td>
                                            <td>{{ $row->size }}</td>
                                            <td>{{ $row->quantity }}</td>
                                            <td>&#8377;{{ $row->single_price }}</td>
                                            <td>&#8377;{{ $row->total_price }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div><!-- table-wrapper -->
                    </div><!-- card -->
                </div>

                @if ($order->status == 0)
                    <a href="{{ url('admin/payment/accept/' . $order->id) }}" class="btn btn-block btn-info">Accept
                        Payment</a>
                    <a href="{{ url('admin/order/cancel/' . $order->id) }}" class="btn btn-block btn-danger">Cancel
                        Order</a>
                @elseif ($order->status == 1)
                    <a href="{{ url('admin/delivery/proccess/' . $order->id) }}" class="btn btn-block btn-info">Process for
                        Delivery</a>
                @elseif ($order->status == 2)
                    <a href="{{ url('admin/delivery/done/' . $order->id) }}" class="btn btn-block btn-success">Delivery
                        Done</a>
                @elseif ($order->status == 4)
                    <div class="alert alert-danger alert-bordered pd-y-20" role="alert">
                        <div class="d-flex align-items-center justify-content-start">
                          <i class="icon ion-ios-close alert-icon tx-52 tx-danger mg-r-20"></i>
                          <div>
                            <h5 class="mg-b-2 tx-danger">Oh snap! Order is Cancelled.</h5>
                            <p class="mg-b-0 tx-gray">Due to some reasons this order is not valid</p>
                          </div>
                        </div><!-- d-flex -->
                      </div><!-- alert -->
                @else
                    <div class="alert alert-success alert-bordered pd-y-20" role="alert">
                        <div class="d-flex align-items-center justify-content-start">
                          <i class="icon ion-ios-checkmark alert-icon tx-52 mg-r-20 tx-success"></i>
                          <div>
                            <h5 class="mg-b-2 tx-success">Great! Product delivered Successfully.</h5>
                            <p class="mg-b-0 tx-gray"></p>
                          </div>
                        </div><!-- d-flex -->
                      </div><!-- alert -->
                @endif


            </div>
        </div>
    </div>

@endsection
