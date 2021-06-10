@extends('layouts.app')
@section('content')

    {{-- STYLING FOR pROGRSS BAR --}}
    <style>
        .progress {
            height: 22px;
            background: #d8d8d8;
            overflow: visible;
            margin-bottom: 70px;
        }

        .progress .progress-bar {
            position: relative;
            animation: animate-positive 2s;
        }

        .progress .progress-value {
            position: absolute;
            bottom: -45px;
            right: -25px;
            padding: 5px 14px;
            background: #383846;
            font-size: 14px;
            color: #fff;
            border-radius: 20px;
            text-align: center;
        }

        .progress .progress-value:after {
            content: "";
            background: #383846;
            padding: 8px;
            border-radius: 50%;
            position: absolute;
            top: -8px;
            left: 45%;
            margin-left: -5px;
        }

        @-webkit-keyframes animate-positive {
            0% {
                width: 0%;
            }
        }

        @keyframes animate-positive {
            0% {
                width: 0%;
            }
        }

    </style>

    <div class="contact_form">
        <div class="container">
            <div class="row">
                <div class="col-5 offset-lg-1">
                    <div class="contact_form_title">
                        <h4>Your order status(#{{ $track->status_code }})</h4>
                    </div>
                    <div class="progress">
                        @if ($track->status == 0)

                            <div class="progress-bar "
                                style="width:15%; background:linear-gradient(to right, #f36262 35%, #e90a0a 68%);">
                                <div class="progress-value" style="bottom: -86px;">Order under review</div>
                            </div>

                        @elseif ($track->status == 1)

                            <div class="progress-bar "
                                style="width:15%; background:linear-gradient(to right, #f36262 35%, #e90a0a 68%);">
                            </div>
                            <div class="progress-bar "
                                style="width:30%; background:linear-gradient(to right,  #f39c12 35%, #be7a07 68%);">
                                <div class="progress-value">Payment accepted</div>
                            </div>

                        @elseif ($track->status == 2)

                            <div class="progress-bar "
                                style="width:15%; background:linear-gradient(to right, #f36262 35%, #e90a0a 68%);">
                            </div>
                            <div class="progress-bar "
                                style="width:30%; background:linear-gradient(to right,  #f39c12 35%, #be7a07 68%);">
                            </div>
                            <div class="progress-bar "
                                style="width:20%; background:linear-gradient(to right, #3398da 35%, #0566a2 68%);">
                                <div class="progress-value" style="bottom: -77px;">Order out for delivery</div>
                            </div>


                        @elseif ($track->status == 3)
                            <div class="progress-bar "
                                style="width:15%; background:linear-gradient(to right, #f36262 35%, #e90a0a 68%);">
                            </div>
                            <div class="progress-bar "
                                style="width:30%; background:linear-gradient(to right,  #f39c12 35%, #be7a07 68%);">
                            </div>
                            <div class="progress-bar "
                                style="width:20%; background:linear-gradient(to right, #3398da 35%, #0566a2 68%);">
                            </div>
                            <div class="progress-bar "
                                style="width:35%; background:linear-gradient(to right, #26ad5f 35%, #087134 68%);">
                                <div class="progress-value">Order delivered</div>
                            </div>

                            

                        @else

                            <div class="progress-bar "
                                style="width:100%; background:linear-gradient(to right, #f36262 35%, #e90a0a 68%);">
                                <div class="progress-value">Order Cancelled</div>
                            </div>

                        @endif
                    </div>

                    @if ($track->status == 3)
                        <a href="{{ url('invoice/'.$track->id) }}" target="_blank" class="text-center">Click here to download invoice</a>
                    @endif
                </div>



                <div class="col-5 offset-lg-1">
                    <div class="contact_form_title">
                        <div class="card">
                            <div class="card-header">
                                <h4>Your order details</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item"><b>Payment type :</b> <span style="float: right;" class="badge badge-dark">{{ $track->payment_type }}</span></li>
                                    <li class="list-group-item"><b>Order ID :</b> <span style="float: right;">#{{ $track->stripe_order_id }}</span></li>
                                    <li class="list-group-item"><b>Tracking ID :</b> <span style="float: right;">#{{ $track->status_code }}</span></li>
                                    <li class="list-group-item"><b>Transaction ID :</b> <span style="float: right;">{{ $track->balance_transaction }}</span></li>
                                    <li class="list-group-item"><b>Payment ID :</b> <span style="float: right;">{{ $track->payment_id }}</span></li>
                                    <li class="list-group-item"><b>Subtotal :</b> <span style="float: right;">&#8377;{{ $track->subtotal }}</span></li>
                                    <li class="list-group-item"><b>Shipping :</b> <span style="float: right;">&#8377;{{ $track->shipping }}</span></li>
                                    <li class="list-group-item"><b>VAT :</b> <span style="float: right;">&#8377;{{ $track->vat }}</span></li>
                                    <li class="list-group-item"><b>Total :</b> <span style="float: right;">&#8377;{{ $track->total }}</span></li>
                                    <li class="list-group-item"><b>Date :</b> <span style="float: right;">{{ $track->date }}</span></li>
                                    <li class="list-group-item"><b>Month / Year :</b> <span style="float: right;">{{ $track->month }} , {{ $track->year }}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
