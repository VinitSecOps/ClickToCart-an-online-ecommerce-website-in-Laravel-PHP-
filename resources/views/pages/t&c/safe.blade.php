@extends('layouts.app')
@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/blog_single_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/blog_single_responsive.css') }}"



    

<div class="single_post">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="single_post_title">
                    Safe Secured Shopping
                
                </div>
                <div class="single_post_text">
                    <p>
                    
                                {!! $setting->safe !!}
                            
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
