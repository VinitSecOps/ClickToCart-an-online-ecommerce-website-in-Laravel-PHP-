@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <span class="breadcrumb-item active">Blog Category</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Blog Category Table
                <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                </a>
            </h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Blog Category List
                <a href="" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3"><i class="fa fa-plus" aria-hidden="true"></i>  Add New</a>
            </h6>


            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-5p">ID</th>
                            <th class="wd-10p">Category Name English</th>
                            <th class="wd-10p">Category Name Hindi</th>
                            <th class="wd-10p">Category Name Gujarati</th>
                            <th class="wd-5p">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blog_categories as $key => $row)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $row->category_name_english }}</td>
                            <td>{{ $row->category_name_hindi }}</td>
                            <td>{{ $row->category_name_gujarati }}</td>
                            <td>
                                <a href="{{ URL::to('edit/blog/category/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</a>
                                <a href="{{ URL::to('delete/blog/category/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
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

<!-- LARGE MODAL -->
<div id="modaldemo3" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-header pd-x-20">
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Blog Category Add</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('store.blog.category') }}" method="POST">
                @csrf
                <div class="modal-body pd-20">

                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Category Name English</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="English" name="category_name_english" required>
                        @error('category_name_english')
                        <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Category Name Hindi</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="हिंदी" name="category_name_hindi" required>
                        @error('category_name_hindi')
                        <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="exampleInputEmail1" class="form-label">Category Name Gujarti</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="ગુજરાતી" name="category_name_gujarati" required>
                        @error('category_name_gujarati')
                        <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>



                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>
                    <button type="button" class="btn btn-secondary pd-x-20" data-dismiss="modal"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</button>
                </div>
            </form>
        </div>

    </div><!-- modal-dialog -->
</div><!-- modal -->

@endsection