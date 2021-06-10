@extends('layouts.app')
@section('content')
@include('layouts.menubar')

@php
    $site = DB::table('sitesetting')->first();
@endphp
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/styles/contact_responsive.css') }}">

<!-- Contact Info -->

<div class="contact_info">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_info_container d-flex flex-lg-row flex-column justify-content-between align-items-between">

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="{{ asset('public/frontend/images/contact_1.png') }}" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Phone</div>
                            <div class="contact_info_text"><a href="tel:{{ $site->phone_one }}" class="text-secondary">+91{{ $site->phone_one }}</a></div>
                        </div>
                    </div>

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="{{ asset('public/frontend/images/contact_2.png') }}" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Email</div>
                            <div class="contact_info_text"><a href="mailto:{{ $site->email }}" class="text-secondary">{{ $site->email }}</a></div>
                        </div>
                    </div>

                    <!-- Contact Item -->
                    <div class="contact_info_item d-flex flex-row align-items-center justify-content-start">
                        <div class="contact_info_image"><img src="{{ asset('public/frontend/images/contact_3.png') }}" alt=""></div>
                        <div class="contact_info_content">
                            <div class="contact_info_title">Address</div>
                            <div class="contact_info_text">{{ $site->company_address }}</div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- Contact Form -->

<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="contact_form_container">
                    <div class="contact_form_title">Get in Touch</div>

                    <form action="{{ route('contact.form') }}" id="contact_form" method="post">
                        @csrf
                        <div class="contact_form_inputs d-flex flex-md-row flex-column justify-content-between align-items-between">
                            <input type="text" name="name" id="contact_form_name" class="contact_form_name input_field" placeholder="Your name" required="required" data-error="Name is required.">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <input type="email" name="email" id="contact_form_email" class="contact_form_email input_field" placeholder="Your email" required="required" data-error="Email is required.">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                            
                            <input type="text" name="phone" id="contact_form_phone" class="contact_form_phone input_field" placeholder="Your phone number">
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                        
                        </div>
                        <div class="contact_form_text">
                            <textarea id="contact_form_message" class="text_field contact_form_message" name="message" rows="4" placeholder="Message"  data-error="Please, write us a message."></textarea>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror                        
                        </div> 
                        <div class="contact_form_button">
                            <button type="submit" class="button contact_submit_button">Send Message</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="panel text-center"></div>
</div>

<!-- Map -->

<div class="contact_map">
    <div id="google_map" class="google_map">
        <div class="map_container">
            <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d448108.42233048595!2d77.208985!3d28.527352!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x82fb9bb175a19449!2sCLICK%20TO%20CART!5e1!3m2!1sen!2sin!4v1620541231412!5m2!1sen!2sin" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</div>

<script src="{{ asset('public/frontend/js/contact_custom.js') }}"></script>

@endsection