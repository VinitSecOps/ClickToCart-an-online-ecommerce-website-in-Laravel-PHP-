@extends('layouts.app')
@section('content')
@include('layouts.menubar')

    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/blog_styles.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/blog_responsive.css') }}">

    <!-- Blog -->

    <div class="blog">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="blog_posts d-flex flex-row align-items-start justify-content-between">

                        @foreach ($posts as $row)


                            <!-- Blog post -->
                            <div class="blog_post">
                                <div class="blog_image" style="background-image:url({{ asset($row->post_image) }});"></div>
                                <div class="blog_text">
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
                                <div class="blog_button">
                                    @if (Session::has('lang'))
                                        @if (Session()->get('lang') == 'english')
                                            <a href="{{ url('blog/single/'.$row->id) }}">Continue Reading</a>
                                        @endif

                                        @if (Session()->get('lang') == 'hindi')
                                            <a href="{{ url('blog/single/'.$row->id) }}">जारी रखें पढ़ रहे हैं</a>
                                        @endif

                                        @if (Session()->get('lang') == 'gujarati')
                                            <a href="{{ url('blog/single/'.$row->id) }}">વાંચન ચાલુ રાખો</a>
                                        @endif
                                    @else
                                        <a href="{{ url('blog/single/'.$row->id) }}">Continue Reading</a>
                                    @endif
                                    
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
