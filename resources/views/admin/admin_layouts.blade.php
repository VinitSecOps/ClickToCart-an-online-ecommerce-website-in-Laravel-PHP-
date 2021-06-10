@php
$setting = DB::table('sitesetting')->first();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>ClickToCart Admin</title>

    <link rel="shortcut icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">  

    <!-- vendor css -->
    <link href="{{ asset('public/backend/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/lib/rickshaw/rickshaw.min.css') }}" rel="stylesheet">

    <!-- Tag input CDN -->
    <link href="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />


    <!-- Toaster CSS -->
    <link rel="stylesheet" rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">

    <!-- Datatable CSS -->
    <link href="{{ asset('public/backend/lib/highlightjs/github.css') }}" rel="stylesheet">
    <link href="{{ asset('public/backend/lib/datatables/jquery.dataTables.css') }}" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <link href="{{ asset('public/backend/lib/select2/css/select2.min.css') }}" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/starlight.css') }}">
    <link href="{{ asset('public/backend/lib/summernote/summernote-bs4.css') }}" rel="stylesheet">


</head>

<body>

    @guest

    @else
        <!-- ########## START: LEFT PANEL ########## -->
        <div class="sl-logo"><a href="{{ url('admin/home') }}"><i class="icon ion-android-star-outline"></i>
                ClickToCart</a></div>
        <div class="sl-sideleft">


            <label class="sidebar-label">Navigation</label>
            <div class="sl-sideleft-menu">


                <a href="{{ url('admin/home') }}" class="sl-menu-link">
                    <div class="sl-menu-item">
                        <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                        <span class="menu-item-label">Dashboard</span>
                    </div><!-- menu-item -->
                </a><!-- sl-menu-link -->



                @if (Auth::user()->reports == 1)

                    <a href="#" class="sl-menu-link">
                        <div class="sl-menu-item">
                            <i class="menu-item-icon icon ion-ios-analytics-outline tx-24"></i>
                            <span class="menu-item-label">Reports</span>
                            <i class="menu-item-arrow fa fa-angle-down"></i>
                        </div><!-- menu-item -->
                    </a><!-- sl-menu-link -->

                    <ul class="sl-menu-sub nav flex-column">
                        <li class="nav-item"><a href="{{ route('today.order') }}" class="nav-link">Today's orders</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('today.delivery') }}" class="nav-link">Today's
                                delivery</a></li>
                        <li class="nav-item"><a href="{{ route('this.month') }}" class="nav-link">This month</a></li>
                        <li class="nav-item"><a href="{{ route('search.report') }}" class="nav-link">Search report</a>
                        </li>
                    </ul>
                @else
                @endif

               


                @if (Auth::user()->categories == 1)
                    <a href="" class="sl-menu-link ">
                        <div class="sl-menu-item ">
                            <i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                            <span class="menu-item-label">Categories</span>
                            <i class="menu-item-arrow fa fa-angle-down"></i>
                        </div><!-- menu-item -->
                    </a><!-- sl-menu-link -->
                    <ul class="sl-menu-sub nav flex-column">
                        <li class="nav-item"><a href="{{ route('categories') }}" class="nav-link">Category</a></li>
                        <li class="nav-item"><a href="{{ route('sub.categories') }}" class="nav-link">Sub Category</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('brands') }}" class="nav-link">Brand</a></li>
                    </ul>
                @else
                @endif


                @if (Auth::user()->products == 1)
                    <a href="#" class="sl-menu-link">
                        <div class="sl-menu-item">
                            <i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                            <span class="menu-item-label">Products</span>
                            <i class="menu-item-arrow fa fa-angle-down"></i>
                        </div><!-- menu-item -->
                    </a><!-- sl-menu-link -->
                    <ul class="sl-menu-sub nav flex-column">
                        <li class="nav-item"><a href="{{ route('add.product') }}" class="nav-link">Add Products</a></li>
                        <li class="nav-item"><a href="{{ route('all.product') }}" class="nav-link">All Products</a></li>
                    </ul>
                @else
                @endif


                @if (Auth::user()->orders == 1)
                    <a href="#" class="sl-menu-link">
                        <div class="sl-menu-item">
                            <i class="menu-item-icon ion-social-buffer-outline tx-20"></i>
                            <span class="menu-item-label">Orders</span>
                            <i class="menu-item-arrow fa fa-angle-down"></i>
                        </div><!-- menu-item -->
                    </a><!-- sl-menu-link -->
                    <ul class="sl-menu-sub nav flex-column">
                        <li class="nav-item"><a href="{{ route('admin.neworder') }}" class="nav-link">New Orders</a></li>
                        <li class="nav-item"><a href="{{ route('admin.accept.payment') }}" class="nav-link">Payment
                                Accepted </a></li>
                        <li class="nav-item"><a href="{{ route('admin.cancel.order') }}" class="nav-link">Cancelled
                                Orders</a></li>
                        <li class="nav-item"><a href="{{ route('admin.process.payment') }}" class="nav-link">Process for
                                Delivery </a></li>
                        <li class="nav-item"><a href="{{ route('admin.success.payment') }}" class="nav-link">Delivery
                                Succeed </a></li>
                    </ul>
                @else
                @endif


                @if (Auth::user()->return_orders == 1)
                    <a href="#" class="sl-menu-link">
                        <div class="sl-menu-item">
                            <i class="menu-item-icon icon ion-ios-refresh-outline tx-24"></i>
                            <span class="menu-item-label">Return orders</span>
                            <i class="menu-item-arrow fa fa-angle-down"></i>
                        </div><!-- menu-item -->
                    </a><!-- sl-menu-link -->
                    <ul class="sl-menu-sub nav flex-column">
                        <li class="nav-item"><a href="{{ route('admin.return.request') }}" class="nav-link">Return
                                request</a></li>
                        <li class="nav-item"><a href="{{ route('admin.all.return') }}" class="nav-link">All request</a>
                        </li>

                    </ul>
                @else
                @endif




                @if (Auth::user()->coupons == 1)
                    <a href="#" class="sl-menu-link">
                        <div class="sl-menu-item">
                            <i class="menu-item-icon icon ion-ios-pricetags-outline tx-20"></i>
                            <span class="menu-item-label">Coupons</span>
                            <i class="menu-item-arrow fa fa-angle-down"></i>
                        </div><!-- menu-item -->
                    </a><!-- sl-menu-link -->
                    <ul class="sl-menu-sub nav flex-column">
                        <li class="nav-item"><a href="{{ route('admin.coupon') }}" class="nav-link">Coupon</a></li>

                    </ul>
                @else
                @endif








                @if (Auth::user()->blogs == 1)
                    <a href="#" class="sl-menu-link">
                        <div class="sl-menu-item">
                            <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
                            <span class="menu-item-label">Blogs</span>
                            <i class="menu-item-arrow fa fa-angle-down"></i>
                        </div><!-- menu-item -->
                    </a><!-- sl-menu-link -->
                    <ul class="sl-menu-sub nav flex-column">
                        <li class="nav-item"><a href="{{ route('add.blog.categorylist') }}" class="nav-link">Blog
                                Category</a></li>
                        <li class="nav-item"><a href="{{ route('add.blog.post') }}" class="nav-link">Add Post</a></li>
                        <li class="nav-item"><a href="{{ route('all.blog.post') }}" class="nav-link">All Post</a></li>
                    </ul>
                @else
                @endif



                @if (Auth::user()->user_roles == 1)
                    <a href="#" class="sl-menu-link">
                        <div class="sl-menu-item">
                            <i class="menu-item-icon icon ion-ios-contact-outline tx-24"></i>
                            <span class="menu-item-label">User Roles</span>
                            <i class="menu-item-arrow fa fa-angle-down"></i>
                        </div><!-- menu-item -->
                    </a><!-- sl-menu-link -->
                    <ul class="sl-menu-sub nav flex-column">
                        <li class="nav-item"><a href="{{ route('add.admin') }}" class="nav-link">Create User</a></li>
                        <li class="nav-item"><a href="{{ route('admin.all.user') }}" class="nav-link">All users</a></li>

                    </ul>
                @else
                @endif

                @if (Auth::user()->contact_messages == 1)
                    <a href="#" class="sl-menu-link">
                        <div class="sl-menu-item">
                            <i class="menu-item-icon icon ion-ios-telephone-outline tx-24"></i>
                            <span class="menu-item-label">Contact Messages</span>
                            <i class="menu-item-arrow fa fa-angle-down"></i>
                        </div><!-- menu-item -->
                    </a><!-- sl-menu-link -->
                    <ul class="sl-menu-sub nav flex-column">
                        <li class="nav-item"><a href="{{ route('all.messages') }}" class="nav-link">All message</a></li>

                    </ul>
                @else
                @endif

             

                @if (Auth::user()->site_settings == 1)
                    <a href="#" class="sl-menu-link">
                        <div class="sl-menu-item">
                            <i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                            <span class="menu-item-label">Site settings</span>
                            <i class="menu-item-arrow fa fa-angle-down"></i>
                        </div><!-- menu-item -->
                    </a><!-- sl-menu-link -->
                    <ul class="sl-menu-sub nav flex-column">
                        <li class="nav-item"><a href="{{ route('admin.site.setting') }}" class="nav-link">settings</a>
                        <li class="nav-item"><a href="{{ route('admin.site.tc.setting') }}" class="nav-link">T&C settings</a>
                        </li>

                    </ul>
                @else
                @endif


                @if (Auth::user()->others == 1)
                    <a href="#" class="sl-menu-link">
                        <div class="sl-menu-item">
                            <i class="menu-item-icon icon ion-ios-toggle-outline tx-24"></i>
                            <span class="menu-item-label">Others</span>
                            <i class="menu-item-arrow fa fa-angle-down"></i>
                        </div><!-- menu-item -->
                    </a><!-- sl-menu-link -->
                    <ul class="sl-menu-sub nav flex-column">
                        <li class="nav-item"><a href="{{ route('admin.newsletter') }}" class="nav-link">Newsletter</a>
                        </li>
                        <li class="nav-item"><a href="{{ route('admin.seo') }}" class="nav-link">SEO Setting</a></li>

                    </ul>
                @else
                @endif

            </div><!-- sl-sideleft-menu -->

            <br>
        </div><!-- sl-sideleft -->
        <!-- ########## END: LEFT PANEL ########## -->

        <!-- ########## START: HEAD PANEL ########## -->
        <div class="sl-header">
            <div class="sl-header-left">
                <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i
                            class="icon ion-navicon-round"></i></a></div>
                <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i
                            class="icon ion-navicon-round"></i></a></div>
            </div><!-- sl-header-left -->
            <div class="sl-header-right">
                <nav class="nav">
                    <div class="dropdown">
                        <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
                            <span class="logged-name">{{ Auth::user()->name }}<span class="hidden-md-down"></span></span>
                            <img src="{{ asset(Auth::user()->avatar) }}" class="wd-35 ht-35 rounded-circle" alt="">
                        </a>
                        <div class="dropdown-menu dropdown-menu-header wd-200">
                            <ul class="list-unstyled user-profile-nav">
                                <li><a href="{{ route('admin.edit.profile') }}"><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                                <li><a href="{{ route('admin.password.change') }}"><i
                                            class="icon ion-ios-gear-outline"></i> Change Password</a></li>
                                <li><a href="{{ route('admin.logout') }}"><i class="icon ion-power"></i> Sign Out</a>
                                </li>
                            </ul>
                        </div><!-- dropdown-menu -->
                    </div><!-- dropdown -->
                </nav>

                @if (Auth::user()->contact_messages == 1)
                <div class="navicon-right">
                    <a id="btnRightMenu" href="" class="pos-relative">
                        <i class="icon ion-ios-bell-outline"></i>
                        <!-- start: if statement -->
                        <span class="square-8 bg-danger"></span>
                        <!-- end: if statement -->
                    </a>
                </div><!-- navicon-right -->
                @else
                @endif
            </div><!-- sl-header-right -->
        </div><!-- sl-header -->
        <!-- ########## END: HEAD PANEL ########## -->
        @php
            $right_panel_mess = DB::table('contact')
                ->orderBy('created_at', 'DESC')
                ->get();
        @endphp
        <!-- ########## START: RIGHT PANEL ########## -->
        <div class="sl-sideright">
            <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages
                        ({{ count($right_panel_mess) }})</a>
                </li>

            </ul><!-- sidebar-tabs -->



            <!-- Tab panes -->
            <div class="tab-content">

                <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="messages" role="tabpanel">
                    <div class="media-list">
                        <div class="pd-15">
                            <a href="{{ route('all.messages') }}"
                                class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View
                                All Messages <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div><!-- media-list -->
                    <!-- loop starts here -->
                    @foreach ($right_panel_mess as $row)
                        <a href="{{ $row->status == 0 ? URL::to('admin/view/message/' . $row->id) : URL::to('admin/view/replied/message/' . $row->id) }}"
                            class="media-list-link">
                            <div class="media">
                                <img src="{{ asset('public/backend/img/img3.jpg') }}" class="wd-40 rounded-circle"
                                    alt="">
                                <div class="media-body">
                                    <p class="mg-b-0 tx-medium tx-gray-800 tx-13">{{ $row->name }} <span
                                            class="d-block tx-11 tx-gray-500"
                                            style="float: right;">{{ Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</span>
                                    </p>
                                    <span class="d-block tx-11 tx-gray-500">{{ $row->email }}</span>
                                    <p class="tx-13 mg-t-10 mg-b-0">{{ str_limit($row->message, $limit = 50) }}</p>
                                </div>
                            </div><!-- media -->
                        </a>
                    @endforeach
                    <!-- loop ends here -->



                </div><!-- #messages -->



            </div><!-- tab-content -->
        </div><!-- sl-sideright -->
        <!-- ########## END: RIGHT PANEL ########## --->

    @endguest


    @yield('admin_content')


    <script src="{{ asset('public/backend/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('public/backend/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('public/backend/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/lib/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('public/backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('public/backend/lib/highlightjs/highlight.pack.js') }}"></script>
    <script src="{{ asset('public/backend/lib/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('public/backend/lib/datatables-responsive/dataTables.responsive.js') }}"></script>
    <script src="{{ asset('public/backend/lib/select2/js/select2.min.js') }}"></script>
    {{-- <script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}
    <script src="//cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>


    

    {{-- Datatable script --}}
    <script>
        $(function() {
            'use strict';

            $('#datatable1').DataTable({
                responsive: true,
                aaSorting: [],
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                    lengthMenu: '_MENU_ items/page',
                }
            });

            // Select2
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity
            });

        });

    </script>

    <script src="{{ asset('public/backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('public/backend/lib/d3/d3.js') }}"></script>
    <script src="{{ asset('public/backend/lib/rickshaw/rickshaw.min.js') }}"></script>
    <script src="{{ asset('public/backend/lib/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('public/backend/lib/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/backend/lib/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('public/backend/lib/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('public/backend/lib/flot-spline/jquery.flot.spline.js') }}"></script>

    <script src="{{ asset('public/backend/lib/medium-editor/medium-editor.js') }}"></script>
    <script src="{{ asset('public/backend/lib/summernote/summernote-bs4.min.js') }}"></script>

    {{-- Summer note text-editor script --}}

    <script>
        $(function() {
            'use strict';

            // Inline editor
            var editor = new MediumEditor('.editable');

            // Summernote editor
            $('#summernote').summernote({
                height: 500,
                tooltip: false
            })
        });

    </script>

    <script>
        $(function() {
            'use strict';

            // Inline editor
            var editor = new MediumEditor('.editable');

            // Summernote editor
            $('#summernote_1').summernote({
                height: 500,
                tooltip: false
            })
        });

    </script>

    <script>
        $(function() {
            'use strict';

            // Inline editor
            var editor = new MediumEditor('.editable');

            // Summernote editor
            $('#summernote_4').summernote({
                height: 500,
                tooltip: false
            })
        });

    </script>

    <script>
        $(function() {
            'use strict';

            // Inline editor
            var editor = new MediumEditor('.editable');

            // Summernote editor
            $('#summernote_2').summernote({
                height: 500,
                tooltip: false
            })
        });

    </script>

    <script src="{{ asset('public/backend/js/starlight.js') }}"></script>
    <script src="{{ asset('public/backend/js/ResizeSensor.js') }}"></script>
    <script src="{{ asset('public/backend/js/dashboard.js') }}"></script>

    <!-- Toaster and SweetAlert -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js">
    </script>
    <script src="{{ asset('https://unpkg.com/sweetalert/dist/sweetalert.min.js') }}"></script>

    {{-- sweetalert confirm delete --}}
    <script>
        $(document).on("click", "#delete", function(e) {
            e.preventDefault();
            var link = $(this).attr("href");
            swal({
                    title: "Are you Want to delete?",
                    text: "Once Delete, This will be Permanently Delete!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = link;
                    } else {
                        swal("Great!", "You Data is Safe!", "success");
                    }
                });
        });

    </script>

    {{-- Toastor notification messages --}}
    <script type="text/javascript">
        @if (Session::has('messege'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
            case 'info':
            toastr.info("{{ Session::get('messege') }}");
            break;
            case 'success':
            toastr.success("{{ Session::get('messege') }}");
            break;
            case 'warning':
            toastr.warning("{{ Session::get('messege') }}");
            break;
            case 'error':
            toastr.error("{{ Session::get('messege') }}");
            break;
            }
        @endif

    </script>

    {{-- load modal again on error script --}}
    @if ($errors->any())
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modaldemo3').modal('show');
            });

        </script>
    @endif


</body>

</html>
