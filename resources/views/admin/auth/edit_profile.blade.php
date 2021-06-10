@extends('admin.admin_layouts')

@section('admin_content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <span class="breadcrumb-item active">Profile</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Edit profile
                <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                </a>
            </h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            


            <form method="POST" action="{{ route('admin.update.profile') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ $profile->email }}" readonly>
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $profile->name }}">
                    @error('name')
                        <span class="text text-danger">{{ $message }}</span>
                    @enderror
                </div>
        
                
        
                <div class="mb-3">
                    <label class="form-control-label">Profile Photo </label><br>
                    <label class="custom-file"><input class="custom-file-input" type="file" id="image"
                            name="avatar" >
                            <span class="custom-file-control custom-file-control-primary"></span>
                    </label>
                </div>
                @error('avatar')
                <span class="text text-danger">{{ $message }}</span>
                 @enderror

                <input type="hidden" name="old_avatar" value="{{ $profile->avatar }}">

                
        
                <div class="mb-3">
                    <img id="showImage" src="{{ (!empty($profile->avatar)) ? asset($profile->avatar) : url('public/media/admin/no_image.jpg') }}" style="width: 100px; height: 100px;">
                </div>

        
                <button type="submit" class="btn btn-primary"><i class="fa fa-history" aria-hidden="true"></i> Update</button>
                <a href="{{ url('admin/home') }}" class="btn btn-secondary pd-x-20"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</a>

            </form>
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
</div>
<!-- ########## END: MAIN PANEL ########## -->
<script type="text/javascript">
    $(document).ready(function(e){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>
@endsection
