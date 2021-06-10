@extends('admin.admin_layouts')

@section('admin_content')

    @if (Auth::user()->contact_messages == 1)

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">

            <nav class="breadcrumb sl-breadcrumb">
                <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
                <span class="breadcrumb-item active">Contact</span>
            </nav>

            <div class="sl-pagebody">
                <div class="sl-page-title">
                    <h5>All messages
                        <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                            <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                        </a>
                    </h5>


                </div><!-- sl-page-title -->

                <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">Message List
                    </h6>


                    <div class="table-wrapper">
                        <table id="datatable1" class="table display responsive nowrap" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th style="width: 400px;">Message</th>
                                    <th>Time</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $row)
                                    <tr>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ str_limit($row->message, $limit = 50) }}</td>
                                        <td>{{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</td>
                                        <td>
                                            @if ($row->status == 0)
                                                <a href="{{ URL::to('admin/view/message/' . $row->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="fa fa-reply"
                                                        aria-hidden="true"></i> Reply</a>
                                            @else
                                                <a href="{{ URL::to('admin/view/replied/message/' . $row->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-check"
                                                        aria-hidden="true"></i>
                                                    Replied</a>

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


