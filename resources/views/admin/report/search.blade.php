@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <span class="breadcrumb-item active">Search report</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>
                Search report
                <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                </a>
            </h5>
        </div>
        
        <div class="row">

            <div class="col-lg-4">
                <div class="card pd-20 pd-sm-40">

                    <div class="table-wrapper">
                        <form action="{{ route('search.by.date') }}" method="POST" >
                            @csrf
                            <div class="modal-body pd-20">
        
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Search by date :</label>
                                    <input type="date" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name="date" value="{{ date('Y-m-d') }}" required> 
                                    @error('date')
                                    <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
        
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-4">
                <div class="card pd-20 pd-sm-40">

                    <div class="table-wrapper">
                        <form action="{{ route('search.by.month') }}" method="POST" >
                            @csrf
                            <div class="modal-body pd-20">
        
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Search by month :</label>
                                   

                                    <input type="month" class="form-control"  aria-describedby="emailHelp"  name="month" value="{{ date('Y-m') }}" required> 

                                    @error('month')
                                    <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
        
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-4">
                <div class="card pd-20 pd-sm-40">

                    <div class="table-wrapper">
                        <form action="{{ route('search.by.year') }}" method="POST" >
                            @csrf
                            <div class="modal-body pd-20">
        
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Search by year :</label>
                                    <select  class="form-control" name="year" required>
                                        @php
                                            $year = date('Y');
                                        @endphp
                                            <option value="{{ $year-2 }}">{{ $year-2 }}</option>
                                            <option value="{{ $year-1 }}">{{ $year-1 }}</option>
                                            <option value="{{ $year }}" selected>{{ $year }}</option>
                                            <option value="{{ $year+1 }}">{{ $year+1 }}</option>
                                            <option value="{{ $year+2 }}">{{ $year+2 }}</option>
                                    </select>
                                    @error('year')
                                    <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
        
                            </div><!-- modal-body -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-info pd-x-20"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
           
        </div>

       
    </div>
</div>

< @endsection