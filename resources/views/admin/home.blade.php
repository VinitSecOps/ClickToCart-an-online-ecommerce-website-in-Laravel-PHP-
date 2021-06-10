@extends('admin.admin_layouts')

@section('admin_content')

@php
    $date = date('d-m-Y');
    $today_orders = DB::table('orders')->where('date',$date)->sum('total');
    
    $month = date('F');
    $this_month = DB::table('orders')->where('month',$month)->sum('total');
    
    $year = date('Y');
    $this_year = DB::table('orders')->where('year',$year)->sum('total');
    
    $date_for_delivered = date('Y-m-d');
    $today_delivered = DB::table('orders')->whereDate('updated_at','=',$date_for_delivered)->where('status',3)->where('return_order',0)->sum('total');
@endphp

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <span class="breadcrumb-item active">Dashboard</span>
    </nav>

    <div class="sl-pagebody">

        <div class="row row-sm">
            <div class="col-sm-6 col-xl-3">
                <div class="card pd-20 bg-primary">
                    <div class="d-flex justify-content-between align-items-center mg-b-10">
                        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Today's order</h6>
                        <a href="javascript:void(0)" class="tx-white-8 hover-white">{{ date('d F Y',strtotime($date)) }}</a>
                    </div><!-- card-header -->
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                        <h3 class="mg-b-0 tx-white tx-lato tx-bold">&#8377; {{ $today_orders }}</h3>
                    </div><!-- card-body -->
                   
                </div><!-- card -->
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                <div class="card pd-20 bg-info">
                    <div class="d-flex justify-content-between align-items-center mg-b-10">
                        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Month's Sales</h6>
                        <a href="javascript:void(0)" class="tx-white-8 hover-white">{{ $month }}</a>
                    </div><!-- card-header -->
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                        <h3 class="mg-b-0 tx-white tx-lato tx-bold">&#8377; {{ $this_month }}</h3>
                    </div><!-- card-body -->
                   
                </div><!-- card -->
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <div class="card pd-20 bg-purple">
                    <div class="d-flex justify-content-between align-items-center mg-b-10">
                        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This Year's Sales</h6>
                        <a href="javascript:void(0)" class="tx-white-8 hover-white">{{ $year }}</a>
                    </div><!-- card-header -->
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                        <h3 class="mg-b-0 tx-white tx-lato tx-bold">&#8377; {{ $this_year }}</h3>
                    </div><!-- card-body -->
                   
                </div><!-- card -->
            </div><!-- col-3 -->
            <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                <div class="card pd-20 bg-sl-primary">
                    <div class="d-flex justify-content-between align-items-center mg-b-10">
                        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Today delivered</h6>
                        <a href="javascript:void(0)" class="tx-white-8 hover-white">{{ date('d F Y',strtotime($date)) }}</a>
                    </div><!-- card-header -->
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="sparkline2">5,3,9,6,5,9,7,3,5,2</span>
                        <h3 class="mg-b-0 tx-white tx-lato tx-bold">&#8377; {{ $today_delivered }}</h3>
                    </div><!-- card-body -->
                   
                </div><!-- card -->
            </div><!-- col-3 -->
        </div><!-- row -->


        <div class="row row-sm mg-t-20">
            <div class="col-xl-12">
              <div class="card overflow-hidden">
                <div class="card-header bg-transparent pd-y-20 d-sm-flex align-items-center justify-content-between">
                  <div class="mg-b-20 mg-sm-b-0">
                    <h6 class="card-title mg-b-5 tx-13 tx-uppercase tx-bold tx-spacing-1">ClickToCart Statistics</h6>
                    <span class="d-block tx-12">{{ date('F d, Y',strtotime($date)) }}</span>
                  </div>
                 
                </div><!-- card-header -->
                <div class="card-body pd-0 bd-color-gray-lighter">
                  <div class="row no-gutters tx-center">
                    
                    <div class="col-6 col-sm-2 pd-y-20">
                      <h4 class="tx-inverse tx-lato tx-bold mg-b-5">{{ DB::table('categories')->count('id') }}</h4>
                      <p class="tx-11 mg-b-0 tx-uppercase">Total categories</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l">
                      <h4 class="tx-inverse tx-lato tx-bold mg-b-5">{{ DB::table('subcategories')->count('id') }}</h4>
                      <p class="tx-11 mg-b-0 tx-uppercase">Total subcategories</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l">
                      <h4 class="tx-inverse tx-lato tx-bold mg-b-5">{{ DB::table('products')->count('id') }}</h4>
                      <p class="tx-11 mg-b-0 tx-uppercase">Total products</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l">
                      <h4 class="tx-inverse tx-lato tx-bold mg-b-5">{{ DB::table('brands')->count('id') }}</h4>
                      <p class="tx-11 mg-b-0 tx-uppercase">Total brands</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l">
                      <h4 class="tx-inverse tx-lato tx-bold mg-b-5">{{ DB::table('users')->count('id') }}</h4>
                      <p class="tx-11 mg-b-0 tx-uppercase">Total users</p>
                    </div><!-- col-2 -->
                    <div class="col-6 col-sm-2 pd-y-20 bd-l">
                      <h4 class="tx-inverse tx-lato tx-bold mg-b-5">{{ DB::table('posts')->count('id') }}</h4>
                      <p class="tx-11 mg-b-0 tx-uppercase">Total blogs</p>
                    </div><!-- col-2 -->
                  </div><!-- row -->
                </div><!-- card-body -->
                <div class="card-body pd-0">
                  <div id="rickshaw2" class="wd-100p ht-200"></div>
                </div><!-- card-body -->
              </div><!-- card -->
        


    
            </div>
        </div><!-- sl-mainpanel -->
</div>
    <!-- ########## END: MAIN PANEL ########## -->
    @endsection