@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <a class="breadcrumb-item" href="{{ url('admin/categories') }}">Category</a>
        <span class="breadcrumb-item active">Edit Category</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Category Update
                <a href="{{ url('admin/categories') }}" class="btn btn-sm btn-primary"
                                style="float: right;">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK
                            </a>
            </h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Category Update

            </h6>


            <div class="table-wrapper">
                <form action="{{ url('update/category/'.$category->id) }}" method="POST">
                    @csrf
                    <div class="modal-body pd-20">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Category" name="category_name" value="{{ $category->category_name }}" required>
                            @error('category_name')
                            <span class="text text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">
                            <i class="fa fa-history" aria-hidden="true"></i>  Update
                        </button>
                        <a href="{{ url('admin/categories') }}" class="btn btn-secondary pd-x-20"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
< @endsection