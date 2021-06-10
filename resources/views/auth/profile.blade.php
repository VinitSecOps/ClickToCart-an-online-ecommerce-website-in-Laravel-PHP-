@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Your profile</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" required autofocus>

                                 
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Phone</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ Auth::user()->phone }}" required autofocus>

                               
                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right">Profile picture</label>

                            <div class="col-md-6">
                                <input type="file" id="avatar" class="form-control{{ $errors->has('avatar') ? ' is-invalid' : '' }}" name="avatar" value="{{ Auth::user()->avatar }}" autofocus>

                                
                                @if ($errors->has('avatar'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('avatar') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type="hidden" name="old_avatar" value="{{ Auth::user()->avatar }}">

                        <br>

                        <div class="form-group row">
                            <label for="avatar" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <img id="showImage" src="{{ (!empty(Auth::user()->avatar)) ? asset(Auth::user()->avatar) : url('public/media/user/no_image.jpg') }}" style="width: 100px; height: 100px;" class="rounded-circle">
                            </div>
                        </div>

                      
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <a href="{{ route('home') }}"><img src="{{ (!empty(Auth::user()->avatar)) ? asset(Auth::user()->avatar) : url('public/media/user/no_image.jpg') }}" class="card-img-top rounded-circle" style="height: 90px; width:90px; margin-left:37%;margin-top:10px;"></a>
                <div class="card-body">
                    <h5 class="text-center"><a href="{{ route('home') }}" class="text-dark">{{ Auth::user()->name }}</a></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="{{ url('profile') }}">Edit profile</a></li>
                    <li class="list-group-item"><a href="{{ route('password.change') }}">Change Password</a></li>
                    <li class="list-group-item"><a href="{{ url('home') }}">Your orders</a></li>
                    <li class="list-group-item"><a href="{{ route('success.orderlist') }}">Return orders</a></li>
                </ul>
                <div class="card-body">
                    <a href="{{ route('user.logout') }}" class="btn btn-danger btn-sm btn-block">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(e){
        $('#avatar').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>
@endsection
