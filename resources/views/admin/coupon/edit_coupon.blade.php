@extends('admin.admin_layouts')

@section('admin_content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
<nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <a class="breadcrumb-item" href="{{ url('admin/coupons') }}">Coupon</a>
        <span class="breadcrumb-item active">Edit Coupon</span>
    </nav>
    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Coupon Update</h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Coupon Update
                <a href="{{ url('admin/coupons') }}" class="btn btn-sm btn-primary"
                style="float: right;">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK
            </a>
            </h6>


            <div class="table-wrapper">
                <form action="{{ url('update/coupon/'.$coupon->id) }}" method="POST"  enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pd-20">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Coupon Code</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Coupon Code" name="coupon" value="{{ $coupon->coupon }}" onkeyup="this.value = this.value.toUpperCase();">
                            @error('coupon')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Discount(%)</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Discount" name="discount" value="{{ $coupon->discount }}">
                            @error('discount')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Coupon image</label>
                            <input type="file" class="form-control" id="image" aria-describedby="emailHelp" name="image">
                            @error('image')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <img src="{{ URL::to($coupon->image) }}" id="logo" height="100px" width="100px" />
                            <input type="hidden" name="old_image" value="{{ $coupon->image }}">
                        </div>

                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20"><i class="fa fa-history" aria-hidden="true"></i>
Update</button>
                        <a href="{{ url('admin/coupons') }}" class="btn btn-secondary pd-x-20">
                            <i class="fa fa-times-circle" aria-hidden="true"></i> Close</a>
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
 @endsection