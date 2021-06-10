@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">

    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <span class="breadcrumb-item active">Return orders</span>
    </nav>
   

    <div class="sl-pagebody">
        <div class="sl-page-title">
           
                 <h5>All Return orders
                    <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                    </a>
                 </h5>
            </h5>
         
            

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">All return order requests
            </h6>


            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-5p">Payment type</th>
                            <th class="wd-10p">Transaction ID</th>
                            <th class="wd-10p">Subtotal</th>
                            <th class="wd-5p">Shipping</th>
                            <th class="wd-5p">Total</th>
                            <th class="wd-5p">Date</th>
                            <th class="wd-5p">Return</th>

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
                                @if ($row->return_order == 1)
                                    <span class="badge badge-warning">Pending</span>
                                @elseif ($row->return_order == 2)
                                    <span class="badge badge-success">Success</span>
                                @endif
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