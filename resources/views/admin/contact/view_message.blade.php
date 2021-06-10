@extends('admin.admin_layouts')

@section('admin_content')
    @if (Auth::user()->contact_messages == 1)

        @if ($message->status == 0)



            <!-- ########## START: MAIN PANEL ########## -->
            <div class="sl-mainpanel">
                <nav class="breadcrumb sl-breadcrumb">
                    <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
                    <a class="breadcrumb-item" href="{{ url('admin/all/messages') }}">Contact</a>
                    <span class="breadcrumb-item active">Reply</span>
                </nav>

                <div class="sl-pagebody">

                    <div class="card pd-20 pd-sm-40">
                        <h6 class="card-body-title">Reply to customer
                            <a href="{{ url('admin/all/messages') }}" class="btn btn-sm btn-primary"
                                style="float: right;">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK
                            </a>
                        </h6>

                        <form method="POST" action="{{ url('admin/reply/message') }}">
                            @csrf
                            <input type="hidden" name="id" value="{{ $message->id }}">
                            <div class="form-layout">
                                <div class="row mg-b-25">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Customer Name: </label>
                                            <input class="form-control" type="text" name="name" readonly
                                                value="{{ $message->name }}">
                                        </div>
                                    </div><!-- col-6 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Customer Email: </label>
                                            <input class="form-control" type="email" name="email" readonly
                                                value="{{ $message->email }}">
                                        </div>
                                    </div><!-- col-6 -->
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-control-label">Customer Phone: </label>
                                            <input class="form-control" type="text" name="phone" readonly
                                                value="+91{{ $message->phone }}">
                                        </div>
                                    </div><!-- col-6 -->

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="form-control-label">Customer Message: </label>
                                            <textarea class="form-control" rows="8" readonly
                                                name="message">{{ $message->message }}</textarea>
                                        </div>
                                    </div><!-- col-6 -->

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Subject: </label>
                                            <input class="form-control" type="text" name="subject" required
                                                placeholder="Enter here subject of the mail">
                                            @error('subject')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div><!-- col-6 -->



                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label">Reply : </label>
                                            <textarea class="form-control" rows="8" name="reply" required
                                                placeholder="write down your respone here..."></textarea>
                                            @error('reply')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div><!-- col-6 -->



                                </div><!-- row -->

                                <div class="form-layout-footer">
                                    <button type="submit" class="btn btn-info mg-r-5"><i class="fa fa-paper-plane"
                                            aria-hidden="true"></i> Send</button>
                                    <a href="{{ url('admin/all/messages') }}" class="btn btn-secondary pd-x-20"><i
                                            class="fa fa-times-circle" aria-hidden="true"></i> Close</a>
                                </div><!-- form-layout-footer -->
                            </div><!-- form-layout -->
                    </div><!-- card -->
                    </form>

                </div><!-- sl-mainpanel -->
        @else
            <script>window.location = "http://localhost/ecommerce/admin/all/messages";</script>
        @endif

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
