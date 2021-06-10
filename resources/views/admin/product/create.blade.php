@extends('admin.admin_layouts')

@section('admin_content')

    @if (Auth::user()->products == 1)

        <link rel="stylesheet"
            href="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006288/BBBootstrap/choices.min.css?version=7.0.0">
        <script src="https://res.cloudinary.com/dxfq3iotg/raw/upload/v1569006273/BBBootstrap/choices.min.js?version=7.0.0">
        </script>

        <!-- ########## START: MAIN PANEL ########## -->
        <div class="sl-mainpanel">
            <nav class="breadcrumb sl-breadcrumb">
                <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
                <a class="breadcrumb-item" href="{{ url('admin/products/all') }}">Product</a>
                <span class="breadcrumb-item active">Add Product</span>
            </nav>

            <div class="sl-pagebody">

                <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">New Product Add
                        <a class="btn tn-sm btn-primary pull-right" href="{{ route('all.product') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>  All Products</a>
                    </h6>

                    <form method="POST" action="{{ route('store.product') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-layout">
                            <div class="row mg-b-25">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Name: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_name"
                                            placeholder="Enter Product Name" required>
                                        @error('product_name')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- col-12 -->


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="product_quantity"
                                            placeholder="Product Quantity" value="" required>
                                        @error('product_quantity')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- col-6 -->

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-control-label">Discount Price(&#8377;): <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="discount_price"
                                            placeholder="Discount Price" value="">
                                        @error('discount_price')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- col-6 -->

                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2-show-search" data-placeholder="Choose Category"
                                            name="category_id" required>
                                            <option label="Choose Category"></option>
                                            @foreach ($categories as $row)
                                                <option value="{{ $row->id }}">{{ $row->category_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div><!-- col-4 -->


                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">SubCategory: <span
                                                class="tx-danger">*</span></label>
                                        <select class="form-control select2-show-search"
                                            data-placeholder="Choose SubCategory" name="subcategory_id" required>
                                            <option label="Choose SubCategory"></option>
                                        </select>
                                        @error('subcategory_id')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div><!-- col-4 -->


                                <div class="col-lg-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Brands: <span class="tx-danger">*</span></label>
                                        <select class="form-control select2-show-search" data-placeholder="Choose Brands"
                                            name="brand_id" required>
                                            <option label="Choose Brands"></option>
                                            @foreach ($brands as $row)
                                                <option value="{{ $row->id }}">{{ $row->brand_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Size: <span
                                                class="tx-danger">*</span></label>

                                        <select id="choices-multiple-remove-button" placeholder="Select Size" multiple
                                            name="product_size[]" id="product_size" required>
                                            @foreach ($sizes as $row)
                                                <option value="{{ $row->code }}">{{ $row->size }}</option>
                                            @endforeach
                                        </select>

                                        @error('product_size')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Color: <span
                                                class="tx-danger">*</span></label>
                                        <select id="choices-multiple-remove-button" placeholder="Select Color" multiple
                                            name="product_color[]" id="product_color" required>
                                            @foreach ($colors as $row)
                                                <option value="{{ $row->color }}">{{ $row->color }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_color')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Selling Price(&#8377;): <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="selling_price"
                                            placeholder="Selling Price" required>
                                        @error('selling_price')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Product Details: <span
                                                class="tx-danger">*</span></label>
                                        <textarea class="form-control" name="product_details" id="summernote"></textarea>
                                        @error('product_details')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- col-12 -->


                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label">Video Link: <span
                                                class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="video_link" placeholder="Video Link" >
                                        @error('video_link')
                                            <span class="text text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div><!-- col-12 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Image One(Main Thumbnail): <span
                                                class="tx-danger">*</span></label><br>

                                        <label class="custom-file">
                                            <input class="custom-file-input" type="file" id="file" name="image_one"
                                                onchange="readURL_1(this);" required>
                                                <span class="custom-file-control custom-file-control-primary"></span>
                                            <img src="#" id="one">
                                        </label>


                                    </div>
                                    @error('image_one')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Image Two: <span
                                                class="tx-danger">*</span></label><br>
                                        <label class="custom-file"><input class="custom-file-input" type="file" id="file"
                                                name="image_two" onchange="readURL_2(this);" required>
                                                <span class="custom-file-control custom-file-control-primary"></span>

                                            <img src="#" id="two">
                                        </label>

                                    </div>
                                    @error('image_two')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="form-control-label">Image three: <span
                                                class="tx-danger">*</span></label><br>
                                        <label class="custom-file"><input class="custom-file-input" type="file" id="file"
                                                name="image_three" onchange="readURL_3(this);" required>
                                                <span class="custom-file-control custom-file-control-primary"></span>

                                            <img src="#" id="three">
                                        </label>

                                    </div>
                                    @error('image_three')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div><!-- col-4 -->
                            </div><!-- row -->
                            <br>
                            <hr>
                            <br><br>

                            <div class="row">
                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="main_slider" value="1">
                                        <span>Main Slider</span>
                                    </label>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="hot_deal" value="1">
                                        <span>Hot deal</span>
                                    </label>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="best_rated" value="1">
                                        <span>Best Reated</span>
                                    </label>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="trend" value="1">
                                        <span>Trend Product</span>
                                    </label>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="mid_slider" value="1">
                                        <span>Mid Slider</span>
                                    </label>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="hot_new" value="1">
                                        <span>Hot New</span>
                                    </label>
                                </div><!-- col-4 -->

                                <div class="col-lg-4">
                                    <label class="ckbox">
                                        <input type="checkbox" name="buyone_getone" value="1">
                                        <span>Buyone Getone</span>
                                    </label>
                                </div><!-- col-4 -->


                            </div><!-- end row -->
                            <br><br>




                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-info mg-r-5"> <i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                                <a href="{{ url('admin/products/all') }}" class="btn btn-secondary pd-x-20"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</a>
                            </div><!-- form-layout-footer -->
                        </div><!-- form-layout -->
                </div><!-- card -->
                </form>

            </div><!-- sl-mainpanel -->
        </div>
        <!-- ########## END: MAIN PANEL ########## -->


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

        <script>
            $(function() {

                'use strict';

                // Select2 by showing the search
                $('.select2-show-search').select2({
                    minimumResultsForSearch: ''
                });

            });

        </script>

        <script>
            $(document).ready(function() {

                var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                    removeItemButton: true,
                    // maxItemCount: 5,
                    searchResultLimit: 5,
                    // renderChoiceLimit: 5
                });


            });

        </script>



        <script type="text/javascript">
            $(document).ready(function() {
                $('select[name="category_id"]').on('change', function() {
                    var category_id = $(this).val();
                    if (category_id) {

                        $.ajax({
                            url: "{{ url('/get/subcategory/') }}/" + category_id,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                var d = $('select[name="subcategory_id"]').empty();
                                $.each(data, function(key, value) {

                                    $('select[name="subcategory_id"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .subcategory_name + '</option>');

                                });
                            },
                        });

                    } else {
                        swal("", "Please Select a Category!", "warning");
                    }

                });
            });

        </script>

        <script type="text/javascript">
            function readURL_1(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#one')
                            .attr('src', e.target.result)
                            .width(200)
                            .height(150);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

        </script>
        <script type="text/javascript">
            function readURL_2(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#two')
                            .attr('src', e.target.result)
                            .width(200)
                            .height(150);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

        </script>
        <script type="text/javascript">
            function readURL_3(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#three')
                            .attr('src', e.target.result)
                            .width(200)
                            .height(150);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

        </script>
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
