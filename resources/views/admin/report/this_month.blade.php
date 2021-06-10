@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">

    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <span class="breadcrumb-item active">Reports</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>
                {{ date('F, Y') }} orders report
                <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                </a>
            </h5>
        </div>

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Report List
            </h6>


            <div class="table-wrapper table-responsive">
                <table id="datatable1" class="table display  nowrap">
                    <thead>
                        <tr>
                            <th class="wd-5p">Payment type</th>
                            <th class="wd-10p">Transaction ID</th>
                            <th class="wd-10p">Subtotal</th>
                            <th class="wd-5p">Shipping</th>
                            <th class="wd-5p">Total</th>
                            <th class="wd-5p">Date</th>
                            <th class="wd-5p">Status</th>
                            <th class="wd-5p">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $row)
                        <tr>
                            <td>{{ $row->payment_type }}</td>
                            <td>{{ $row->balance_transaction }}</td>
                            <td>&#8377;{{ $row->subtotal }}</td>
                            <td>&#8377;{{ $row->shipping }}</td>
                            <td>&#8377;{{ $row->total }}</td>
                            <td>{{ $row->date }}</td>
                            <td>
                                @if ($row->status == 0)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($row->status == 1)
                                    <span class="badge badge-info">Payment Accept</span>
                                @elseif ($row->status == 2)
                                    <span class="badge badge-secondary">Progress</span>
                                @elseif ($row->status == 3)
                                    <span class="badge badge-success">Delivered</span>
                                @else
                                    <span class="badge badge-danger">Cancelled</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ URL::to('admin/view/order/'.$row->id) }}" class="btn btn-sm btn-info">
                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
</div>
<!-- ########## END: MAIN PANEL ########## -->


@endsection