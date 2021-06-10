@extends('layouts.app')
@section('content')
@include('layouts.menubar')

<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/blog_single_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/blog_single_responsive.css') }}">


@foreach ($posts as $row)


<div class="single_post">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <img src="{{ asset($row->post_image) }}" alt="" style="width: 750px; height: 500px;">
            </div>
        </div>
    </div>
</div>
    

<div class="single_post">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="single_post_title">
                    
                    @if (Session::has('lang'))
                        @if (Session()->get('lang') == 'english')
                            {{ $row->post_title_english }}
                        @endif

                        @if (Session()->get('lang') == 'hindi')
                            {{ $row->post_title_hindi }}
                        @endif

                        @if (Session()->get('lang') == 'gujarati')
                            {{ $row->post_title_gujarati }}
                        @endif
                    @else
                        {{ $row->post_title_english }}
                    @endif
                </div>
                <div class="single_post_text">
                    <p>
                        @if (Session::has('lang'))
                            @if (Session()->get('lang') == 'english')
                                {!! $row->deatils_english !!}
                            @endif
        
                            @if (Session()->get('lang') == 'hindi')
                                {!! $row->deatils_hindi !!}
                            @endif
        
                            @if (Session()->get('lang') == 'gujarati')
                                {!! $row->deatils_gujarati !!}
                            @endif
                        @else
                            {!! $row->deatils_english !!}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection