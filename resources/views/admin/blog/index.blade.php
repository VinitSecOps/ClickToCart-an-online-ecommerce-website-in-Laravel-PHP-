@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <span class="breadcrumb-item active">Blog Post</span>
    </nav>

    <div class="sl-pagebody">

        <div class="sl-page-title">
            <h5>Blog Post Table
                <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                </a>
            </h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Blog Post List
                <a href="{{ route('add.blog.post') }}" class="btn btn-sm btn-warning" style="float: right;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
            </h6>


            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap" width="100%">
                    <thead>
                        <tr>
                            <th class="wd-5p">ID</th>
                            <th style="width: 300px;">Post Title</th>
                            <th class="wd-10p">Post Category</th>
                            <th class="wd-10p">Image</th>
                            <th class="wd-5p">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $key => $row)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ str_limit($row->post_title_english, $limit = 50) }}</td>
                            <td>{{ $row->category_name_english }}</td>
                            <td><img src="{{ URL::to($row->post_image) }}" width="120px" height="100px"></td>
                            <td>
                                <a href="{{ URL::to('edit/blog/post/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                <a href="{{ URL::to('delete/blog/post/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><!-- table-wrapper -->
        </div><!-- card -->

    </div><!-- sl-mainpanel -->
</div>
<!-- ########## END: MAIN PANEL ########## -->



@endsection