@extends('admin.admin_layouts')

@section('admin_content')
    @if (Auth::user()->products == 1)

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">
            <nav class="breadcrumb sl-breadcrumb">
                <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
                <a class="breadcrumb-item" href="{{ url('admin/products/all') }}">Product</a>
                <span class="breadcrumb-item active">Quick Product View</span>
            </nav>

            <div class="sl-pagebody">

                <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">PRoduct Details Page
                        <a class="btn tn-sm btn-primary pull-right" href="{{ route('all.product') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  All Products</a>
                    </h6>


                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label ">Product Name: </label><br>
                                    <strong>{{ $product->product_name }}</strong>
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Product Code: </label><br>
                                    <strong>{{ $product->product_code }}</strong>
                                </div>
                            </div><!-- col-6 -->

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Quantity: </label><br>
                                    <strong>{{ $product->product_quantity }}</strong>
                                </div>
                            </div><!-- col-6 -->

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Discount Price: </label><br>
                                    <strong>&#8377; {{ ($product->discount_price == "") ? 0 :  $product->discount_price }}</strong>
                                </div>
                            </div><!-- col-6 -->

                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category: </label><br>
                                    <strong>{{ $product->category_name }}</strong>
                                </div>
                            </div><!-- col-4 -->


                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">SubCategory: </label><br>
                                    <strong>{{ $product->subcategory_name }}</strong>
                                </div>
                            </div><!-- col-4 -->


                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Brands: </label><br>
                                    <strong>{{ $product->brand_name }}</strong>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Size: </label><br>
                                    <strong>{{ $product->product_size }}</strong>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Color: </label><br>
                                    <strong>{{ $product->product_color }}</strong>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Selling Price: </label><br>
                                    <strong>&#8377; {{ $product->selling_price }}</strong>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Product Details: </label>
                                    {!! $product->product_details !!}
                                </div>
                            </div><!-- col-12 -->


                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Video Link: </label><br>
                                    <strong><a
                                            href="{{ $product->video_link }}">{{ $product->video_link }}</a></strong>
                                </div>
                            </div><!-- col-12 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Image One(Main Thumbnail): </label><br>
                                    <label class="custom-file">

                                        <img src="{{ URL::to($product->image_one) }}" height="150px" width="200px">
                                    </label>

                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Image Two: </label><br>
                                    <label class="custom-file">
                                        <img src="{{ URL::to($product->image_two) }}" height="150px" width="200px">
                                    </label>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Image three: </label><br>
                                    <label class="custom-file">
                                        <img src="{{ URL::to($product->image_three) }}" height="150px" width="200px">
                                    </label>
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->
                        <br>
                        <hr>
                        <br><br>

                        <div class="row">
                            <div class="col-lg-4">
                                <label>
                                    @if ($product->main_slider)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                    <span>Main Slider</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label>
                                    @if ($product->hot_deal)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                    <span>Hot deal</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label>
                                    @if ($product->best_rated)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                    <span>Best Rated</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label>
                                    @if ($product->trend)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                    <span>Trend Product</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label>
                                    @if ($product->mid_slider)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                    <span>Mid Slider</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label>
                                    @if ($product->hot_new)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                    <span>Hot New</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label>
                                    @if ($product->buyone_getone)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Inactive</span>
                                    @endif
                                    <span>Buyone Getone</span>
                                </label>
                            </div><!-- col-4 -->


                        </div><!-- end row --><br><br>
                        <center><a href="{{ url('admin/products/all') }}" class="btn btn-secondary pd-x-20"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</a>
                        </center>
                    </div><!-- form-layout -->

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
