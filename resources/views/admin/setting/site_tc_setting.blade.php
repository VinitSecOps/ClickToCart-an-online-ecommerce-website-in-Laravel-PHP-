@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
            <span class="breadcrumb-item active">Website T&C settings</span>
        </nav>

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">T&C settings
                    <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                    </a>
                </h6>

                <form method="POST" action="{{ route('update.sitetcseting') }}">
                    @csrf

                    <input type="hidden" name="id" value="{{ $setting->id }}">

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Disclaimer: <span class="tx-danger">*</span></label>
                            <textarea class="form-control" name="disclaimer"
                                id="summernote_1">{!! $setting->disclaimer !!}</textarea>
                            @error('disclaimer')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- col-12 -->
                    <br><br>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Privacy Policy: <span class="tx-danger">*</span></label>
                            <textarea class="form-control" name="policy"
                                id="summernote_2">{!! $setting->policy !!}</textarea>
                            @error('policy')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- col-12 -->
                    <br><br>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Safe Secured Shopping: <span class="tx-danger">*</span></label>
                            <textarea class="form-control" name="safe"
                                id="summernote">{!! $setting->safe !!}</textarea>
                            @error('safe')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- col-12 -->
                    <br><br>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="form-control-label">Terms of Use: <span class="tx-danger">*</span></label>
                            <textarea class="form-control" name="terms"
                                id="summernote_4">{!! $setting->terms !!}</textarea>
                            @error('terms')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div><!-- col-12 -->


<hr>
                    <br>

                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info mg-r-5">
                           <i class="fa fa-history" aria-hidden="true"></i>
                            Update
                        </button>
                        <a href="{{ url('admin/home') }}" class="btn btn-secondary pd-x-20"><i class="fa fa-times-circle"
                                aria-hidden="true"></i> Close</a>
                    </div><!-- form-layout-footer -->

            </div><!-- card -->
            </form>

        </div><!-- sl-mainpanel -->
    </div>
    <!-- ########## END: MAIN PANEL ########## -->





@endsection
