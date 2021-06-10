@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_responsive.css') }}">


<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1 " style="border: solid white; padding: 20px; border-radius: 25px;width: 250px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            ">
                <div class="contact_form_container">
                    <div class="contact_form_title text-center">Sign in</div>

                    <form action="{{ route('login') }}" method="POST" id="contact_form">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email or Phone</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" aria-describedby="emailHelp" required pattern="^(?:[6-9]\d{9}|\w+@\w+\.\w{2,3})$" title="Please enter a valid email address or a phone number">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" aria-describedby="emailHelp" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="contact_form_button">
                            <button type="submit" class="btn btn-info">Login</button>
                        </div>
                    </form><br>
                    <a class="registration" href="{{route('register')}}">Create new account</a><br>
                    <a href="{{ route('password.request') }}">I forgot my password</a><br><br>
                    <a href="{{ url('/auth/redirect/facebook') }}" class="btn btn-primary btn-block"><i class="fab fa-facebook-square"></i> Continue with Facebook</a>
                    <a href="{{ url('/auth/redirect/google') }}" class="btn btn-danger btn-block"><i class="fab fa-google"></i> Continue with Google</a>

                </div>
            </div>

        </div>
    </div>
    <div class="panel"></div>
</div>
@endsection