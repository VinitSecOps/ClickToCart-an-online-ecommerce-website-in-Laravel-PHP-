@extends('admin.admin_layouts')

@section('admin_content')


    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
            <a class="breadcrumb-item" href="{{ url('admin/all/user') }}">Admin</a>
            <span class="breadcrumb-item active">Add admin</span>
        </nav>

        <div class="sl-pagebody">

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">New admin
                    <a href="{{ url('admin/all/user') }}" class="btn btn-sm btn-primary"
                                style="float: right;">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK
                            </a>
                </h6>

                <form method="POST" action="{{ route('store.admin') }}" data-parsley-validate>
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Name: </label>
                                    <input class="form-control" type="text" name="name" placeholder="Enter admin's Name"
                                        required>
                                    @error('name')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-12 -->


                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label">Phone (+91): </label>
                                    <input class="form-control" type="text" name="phone" placeholder="Enter phone number"
                                        value="" required>
                                    @error('phone')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Email : </label>
                                    <input class="form-control" type="email" name="email" placeholder="Enter email address"
                                        value="" required>
                                    @error('email')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Password : </label>
                                    <input class="form-control" type="password" name="password" placeholder="Enter password"
                                        value="">
                                    @error('password')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Confirm Password : </label>
                                    <input class="form-control" type="password" name="password_confirmation"
                                        placeholder="Re-type your password" value="">
                                    @error('password_confirmation')
                                        <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div><!-- col-6 -->


                        </div><!-- row -->

                        <hr>
                        <h5>Pages access: </h5>
                        <br>


                        <div class="row">
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="reports" value="1">
                                    <span><i class="menu-item-icon icon ion-ios-analytics-outline tx-24"></i>
                                        Reports</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="categories" value="1">
                                    <span><i class="menu-item-icon ion-ios-pie-outline tx-20"></i>
                                        Categories</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="products" value="1">
                                    <span><i class="menu-item-icon icon ion-ios-filing-outline tx-24"></i>
                                        Products</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="orders" value="1">
                                    <span> <i class="menu-item-icon ion-social-buffer-outline tx-20"></i>
                                        Orders</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="return_orders" value="1">
                                    <span> <i class="menu-item-icon icon ion-ios-refresh-outline tx-24"></i>
                                        Return orders</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="coupons" value="1">
                                    <span> <i class="menu-item-icon icon ion-ios-pricetags-outline tx-20"></i>
                                        Coupons</span>
                                </label>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="blogs" value="1">
                                    <span> <i class="menu-item-icon icon ion-ios-paper-outline tx-22"></i>
                                        Blogs</span>
                                </label>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="user_roles" value="1">
                                    <span>
                                        <i class="menu-item-icon icon ion-ios-contact-outline tx-24"></i>
                                        User Roles
                                    </span>
                                </label>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="contact_messages" value="1">
                                    <span> <i class="menu-item-icon icon ion-ios-telephone-outline tx-24"></i>
                                        Contact Messages</span>
                                </label>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="product_comments" value="1">
                                    <span> <i class="menu-item-icon icon ion-ios-chatboxes-outline tx-24"></i>
                                        Product comments</span>
                                </label>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="site_settings" value="1">
                                    <span><i class="menu-item-icon icon ion-ios-gear-outline tx-24"></i>
                                        Site settings</span>
                                </label>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <label class="ckbox">
                                    <input type="checkbox" name="others" value="1">
                                    <span><i class="menu-item-icon icon ion-ios-toggle-outline tx-24"></i>
                                        Others</span>
                                </label>
                            </div><!-- col-4 -->


                        </div><!-- end row -->
                        <br><br>




                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                            <a href="{{ url('admin/all/user') }}" class="btn btn-secondary pd-x-20"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</a>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
            </div><!-- card -->
            </form>

        </div><!-- sl-mainpanel -->
    </div>
    <!-- ########## END: MAIN PANEL ########## -->




@endsection
