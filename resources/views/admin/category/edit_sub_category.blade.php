@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <a class="breadcrumb-item" href="{{ url('admin/sub/categories') }}">SubCategory</a>
        <span class="breadcrumb-item active">Edit SubCategory</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Sub Category Update
                <a href="{{ url('admin/sub/categories') }}" class="btn btn-sm btn-primary"
                                style="float: right;">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK
                            </a>
            </h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Sub Category Update

            </h6>


            <div class="table-wrapper">
                <form action="{{ url('update/sub/category/'.$sub_category->id) }}" method="POST">
                    @csrf
                    <div class="modal-body pd-20">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Sub Category Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category" name="subcategory_name" value="{{ $sub_category->subcategory_name }}" required>
                            @error('subcategory_name')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category Name</label>
                            <select name="category_id" class="form-control select2-show-search" data-placeholder="Choose Category" required>
                            <option label="Choose Category"></option>
                            @foreach($categories as $row)
                                <option value="{{ $row->id }}" <?php
                                                                if ($row->id == $sub_category->category_id) {
                                                                    echo "selected";
                                                                } ?>>{{ $row->category_name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20"><i class="fa fa-history" aria-hidden="true"></i> Update</button>
                        <a href="{{ url('admin/sub/categories') }}" class="btn btn-secondary pd-x-20"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script>
    $(function() {

        'use strict';

        // Select2 by showing the search
        $('.select2-show-search').select2({
            minimumResultsForSearch: ''
        });

    });
</script>
< @endsection