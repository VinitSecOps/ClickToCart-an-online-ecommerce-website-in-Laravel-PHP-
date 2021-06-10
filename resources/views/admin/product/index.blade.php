@extends('admin.admin_layouts')

@section('admin_content')
    {{-- IF USER IS AUTHORIZED --}}
    @if (Auth::user()->products == 1)

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">

            <nav class="breadcrumb sl-breadcrumb">
                <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
                <span class="breadcrumb-item active">Product</span>
            </nav><!-- breadcrumb sl-breadcrumb -->

            <div class="sl-pagebody">

                <div class="sl-page-title">
                    <h5>Product Table</h5>
                </div><!-- sl-page-title -->

                <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">Product List
                        <a href="{{ route('add.product') }}" class="btn btn-sm btn-warning" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                    </h6>

                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>Sr</th>
                                    <th>Product Name</th>
                                    <th>Image</th>
                                    <th>Category</th>
                                    <th>Brand</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $row)
                                    <tr>
                                        <!-- <td>{{ $row->product_code }}</td> -->
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $row->product_name }}</td>
                                        <td><img src="{{ URL::to($row->image_one) }}" height="80px" width="100px"></td>
                                        <td>{{ $row->category_name }}</td>
                                        <td>{{ $row->brand_name }}</td>
                                        <td>{{ $row->product_quantity }}</td>
                                        <td>
                                            @if ($row->status == 1)
                                                <span class="badge badge-success">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ URL::to('edit/product/' . $row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                            <a href="{{ URL::to('delete/product/' . $row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            <a href="{{ URL::to('view/product/' . $row->id) }}" class="btn btn-sm btn-warning" title="Quick View"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                            @if ($row->status == 1)
                                                <a href="{{ URL::to('inactive/product/' . $row->id) }}" class="btn btn-sm btn-danger" title="Inactive"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
                                            @else
                                                <a href="{{ URL::to('active/product/' . $row->id) }}" class="btn btn-sm btn-info" title="Active"><i class="fa fa-thumbs-up"></i></a>
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

    {{-- IF USER IS NOT AUTHORIZED --}}
    @else
        <div class="sl-mainpanel">
            <div class="alert alert-danger alert-bordered pd-y-20" role="alert">
                <div class="d-flex align-items-center justify-content-start">
                    <i class="icon ion-ios-close alert-icon tx-52 tx-danger mg-r-20"></i>
                    <div>
                        <h5 class="mg-b-2 tx-danger">Oh snap! Access denied.</h5>
                        <p class="mg-b-0 tx-gray">Please contact admin as you don't have access to this URl</p>
                    </div>
                </div><!-- d-flex -->
            </div><!-- alert -->
        </div>
    @endif
@endsection
