@extends('layouts.app')
@section('content')
    @include('layouts.menubar')
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
   
    <!-- Navbar (sit on top) -->
   

    <!-- Header -->
    <header class="w3-display-container w3-content w3-wide" style="max-width:1600px;min-width:500px" id="home">
        <img class="w3-image" src="{{ asset('public/frontend/images/about.jpg') }}" alt="Hamburger Catering" width="1600" height="800">
        <div class="w3-display-bottomleft w3-padding-large w3-opacity">
        </div>
    </header>

    <!-- Page content -->
    <div class="w3-content" style="max-width:1100px">

        <!-- About Section -->
        <div class="w3-row w3-padding-64" id="about">
            <div class="w3-col m6 w3-padding-large w3-hide-small">
                <img src="{{ asset('public/frontend/images/blog-2.jpg') }}" class="w3-round w3-image w3-opacity-min" alt="Table Setting"
                    width="600" height="750">
            </div>

            <div class="w3-col m6 w3-padding-large">
                <h1 class="w3-center">About us</h1><br>
                <h5 class="w3-center">Working since 2020</h5>
                <p class="w3-large">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.<span class="w3-tag w3-light-grey">seasonal</span> fashion.</p>
                <p class="w3-large w3-text-grey w3-hide-medium">Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod
                    temporincididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                    ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </div>

        <hr>

        <!-- Menu Section -->
        <div class="w3-row w3-padding-64" id="menu">
            <div class="w3-col l6 w3-padding-large">
                <h1 class="w3-center">Our Service</h1><br>
                <h4>Free delivery</h4>
                <p class="w3-text-grey">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus quaerat minima, ea deserunt exercitationem cupiditate at debitis architecto id doloremque illo assumenda incidunt accusamus! Pariatur earum vero iste beatae. Laudantium.</p><br>

                <h4>Good quality</h4>
                <p class="w3-text-grey">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, quidem ipsum? Cum deleniti molestiae pariatur repellat sunt temporibus magni praesentium beatae asperiores, magnam aliquid! Quam minima at ea tempora dolorum!</p><br>

                <h4>Available</h4>
                <p class="w3-text-grey">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sapiente laudantium corporis quam distinctio praesentium id explicabo, vel ullam cumque assumenda neque consequatur blanditiis voluptate exercitationem, nobis atque numquam quisquam ipsa?</p><br>

                <h4>Recommend</h4>
                <p class="w3-text-grey">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque aperiam perspiciatis voluptates distinctio, dolorem expedita id impedit! Saepe, quisquam maiores possimus labore, provident aliquid perspiciatis voluptas beatae incidunt nemo nam.</p><br>

                <h4>Affilate</h4>
                <p class="w3-text-grey">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Eaque quos perferendis, magni aliquam, accusantium esse repellendus minus, fugit consequatur fugiat nulla quas corrupti in ducimus harum? Quidem suscipit dolorum esse.</p>
            </div>

            <div class="w3-col l6 w3-padding-large">
                <img src="{{ asset('public/frontend/images/blog-recent-posts-4.jpg') }}" class="w3-round w3-image w3-opacity-min" alt="Menu"
                    style="width:100%">
            </div>
        </div>

        <hr>


        <!-- End page content -->
    </div>
@endsection
