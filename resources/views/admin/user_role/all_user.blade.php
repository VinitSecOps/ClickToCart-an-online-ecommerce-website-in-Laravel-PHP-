@extends('admin.admin_layouts')

@section('admin_content')



<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <span class="breadcrumb-item active">Admin</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Admin Table
                <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                </a>
            </h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Admin List
                <a href="{{ route('add.admin') }}" class="btn btn-sm btn-warning" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i>  Add New</a>
            </h6>


            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-5p">Name</th>
                            <th class="wd-10p">Phone</th>
                            <th class="wd-5p">Access</th>
                            <th class="wd-5p">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $row)
                        <tr>
                            <td>{{ $row->name }}</td>
                            <td>+91{{ $row->phone }}</td>
                            <td>
                                @if ($row->reports == 1)
                                    <span class="badge badge-primary">Reports</span>
                                @else
                                @endif

                                
                                @if ($row->categories == 1)
                                    <span class="badge badge-secondary">Categories</span>
                                @else
                                @endif

                                @if ($row->products == 1)
                                    <span class="badge badge-success">Products</span>
                                @else
                                @endif

                                @if ($row->orders == 1)
                                    <span class="badge badge-danger">Orders</span>
                                @else
                                @endif

                                @if ($row->return_orders == 1)
                                    <span class="badge badge-warning">Return orders</span>
                                @else
                                @endif

                                @if ($row->coupons == 1)
                                    <span class="badge badge-info">Coupons</span>
                                @else
                                @endif

                                @if ($row->blogs == 1)
                                    <span class="badge badge-secondary">Blogs</span>
                                @else
                                @endif

                                @if ($row->user_roles == 1)
                                    <span class="badge badge-dark">User roles</span>
                                @else
                                @endif

                                @if ($row->contact_messages == 1)
                                    <span class="badge badge-primary">Contact messages</span>
                                @else
                                @endif

                                @if ($row->product_comments == 1)
                                    <span class="badge badge-secondary">Product comments</span>
                                @else
                                @endif

                                @if ($row->site_settings == 1)
                                    <span class="badge badge-success">Site settings</span>
                                @else
                                @endif

                                @if ($row->others == 1)
                                    <span class="badge badge-danger">Others</span>
                                @else
                                @endif


                            </td>
                            <td>
                                <a href="{{ URL::to('edit/admin/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                <a href="{{ URL::to('delete/admin/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
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