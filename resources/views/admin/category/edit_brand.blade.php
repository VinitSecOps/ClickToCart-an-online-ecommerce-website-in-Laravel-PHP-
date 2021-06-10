@extends('admin.admin_layouts')

@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <a class="breadcrumb-item" href="{{ url('admin/brands') }}">Brand</a>
        <span class="breadcrumb-item active">Edit Brand</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Brand Update
                <a href="{{ url('admin/brands') }}" class="btn btn-sm btn-primary"
                                style="float: right;">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK
                            </a>
            </h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Brand Update

            </h6>


            <div class="table-wrapper">
                <form action="{{ url('update/brand/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pd-20">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Brand Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category" name="brand_name" value="{{ $brand->brand_name }}">
                            @error('brand_name')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Brand Logo</label>
                            <input type="file" class="form-control" id="image" aria-describedby="emailHelp" name="brand_logo">
                            @error('brand_logo')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <img src="{{ URL::to($brand->brand_logo) }}" id="logo" height="70px" width="90px" />
                            <input type="hidden" name="old_logo" value="{{ $brand->brand_logo }}">
                        </div>

                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20"><i class="fa fa-history" aria-hidden="true"></i> Update</button>
                        <a href="{{ url('admin/brands') }}" class="btn btn-secondary pd-x-20"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(e) {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
< @endsection