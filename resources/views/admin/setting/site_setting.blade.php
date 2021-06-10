@extends('admin.admin_layouts')

@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
            <span class="breadcrumb-item active">Website settings</span>
        </nav>

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Site settings
                    <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                    </a>
                </h6>

                <form method="POST" action="{{ route('update.siteseting') }}">
                    @csrf

                    <input type="hidden" name="id" value="{{ $setting->id }}">
                    <div class="form-layout">
                        <div class="row mg-b-25">

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Phone one : </label>
                                    <input class="form-control" type="text" name="phone_one" required
                                        value="{{ $setting->phone_one }}">
                                    @error('phone_one')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-12 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Phone two : </label>
                                    <input class="form-control" type="text" name="phone_two" required
                                        value="{{ $setting->phone_two }}">
                                    @error('phone_two')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-12 -->




                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Email : </label>
                                    <input class="form-control" type="email" name="email" value="{{ $setting->email }}"
                                        required>
                                    @error('email')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->




                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Company name : </label>
                                    <input class="form-control" type="text" name="company_name"
                                        value="{{ $setting->company_name }}" required>
                                    @error('company_name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Company Address : </label>
                                    <textarea class="form-control"
                                        name="company_address">{{ $setting->company_address }}</textarea>
                                    @error('company_address')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">
                                        <a href="javascript:void(0)" class="btn btn-primary btn-icon">
                                            <div><i class="fa fa-facebook" aria-hidden="true"></i></div>
                                        </a> Facebook :
                                    </label>

                                    <input class="form-control" type="text" name="facebook"
                                        value="{{ $setting->facebook }}">
                                    @error('facebook')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">
                                        <a href="javascript:void(0)" class="btn btn-danger btn-icon">
                                            <div><i class="fa fa-youtube-play" aria-hidden="true"></i></div>
                                        </a> Youtube :
                                    </label>
                                    <input class="form-control" type="text" name="youtube"
                                        value="{{ $setting->youtube }}">
                                    @error('youtube')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">
                                        <a href="javascript:void(0)" class="btn btn-primary btn-icon">
                                            <div><i class="fa fa-instagram" aria-hidden="true"></i></div>
                                        </a> Instagram :
                                    </label>
                                    <input class="form-control" type="text" name="instagram"
                                        value="{{ $setting->instagram }}">
                                    @error('instagram')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">
                                        <a href="javascript:void(0)" class="btn btn-info btn-icon">
                                            <div><i class="fa fa-twitter" aria-hidden="true"></i> </div>
                                        </a> Twitter :
                                    </label>
                                    <input class="form-control" type="text" name="twitter"
                                        value="{{ $setting->twitter }}">
                                    @error('twitter')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->



                        </div><!-- row -->

                        <hr>

                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5"><i class="fa fa-history"
                                    aria-hidden="true"></i>
                                Update</button>
                            <a href="{{ url('admin/home') }}" class="btn btn-secondary pd-x-20"><i
                                    class="fa fa-times-circle" aria-hidden="true"></i> Close</a>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
            </div><!-- card -->
            </form>

        </div><!-- sl-mainpanel -->




        <br>
        {{-- ####################################################################################################### --}}




        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Logo settings
                    </a>
                </h6>

                <form method="POST" action="{{ route('update.logo.siteseting') }}" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="id" value="{{ $setting->id }}">
                    <div class="form-layout">
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">

                                <label class="form-control-label">Logo: <span class="tx-danger">*</span></label><br>
                                <label class="custom-file">
                                    <input class="custom-file-input" type="file" id="file" name="logo" onchange="readURL_1(this);">
                                    <span class="custom-file-control custom-file-control-primary"></span>
                                </label>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <img src="{{ URL::to($setting->logo) }}" width="120px" height="120px" id="one">
                                <input type="hidden" name="old_logo" value="{{ $setting->logo }}">
                            </div>
                            @error('logo')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <hr>  
                        <div class="row">
                            <div class="col-lg-6 col-sm-6">
                                <label class="form-control-label">Favicon: <span class="tx-danger">*</span></label><br>
                                <label class="custom-file"><input class="custom-file-input" type="file" id="file"
                                        name="favicon" onchange="readURL_2(this);">
                                    <span class="custom-file-control custom-file-control-primary"></span>
                                </label>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <img src="{{ URL::to($setting->favicon) }}" width="50px" height="50px" id="two">
                                <input type="hidden" name="old_favicon" value="{{ $setting->favicon }}">
                            </div>
                            @error('favicon')
                                <span class="text text-danger">{{ $message }}</span>
                            @enderror

                        </div><!-- row -->


                        <hr>

                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5"><i class="fa fa-history"
                                    aria-hidden="true"></i> Update</button>
                            <a href="{{ url('admin/home') }}" class="btn btn-secondary pd-x-20"><i
                                    class="fa fa-times-circle" aria-hidden="true"></i> Close</a>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
            </div><!-- card -->


        </div><!-- sl-mainpanel -->
    </div>
    <!-- ########## END: MAIN PANEL ########## -->

    <script type="text/javascript">
        function readURL_1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#one')
                        .attr('src', e.target.result)
                        .width(120)
                        .height(120);
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
                        .width(50)
                        .height(50);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>



@endsection
