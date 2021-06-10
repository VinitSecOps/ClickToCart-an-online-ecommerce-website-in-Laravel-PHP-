@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">

    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <span class="breadcrumb-item active">Coupon</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Coupon Table
                <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                </a>
            </h5>

        </div><!-- sl-page-title -->

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Coupon List
                <a href="" class="btn btn-sm btn-warning" style="float: right;" data-toggle="modal" data-target="#modaldemo3"><i class="fa fa-plus" aria-hidden="true"></i>  Add New</a>
            </h6>


            <div class="table-wrapper">
                <table id="datatable1" class="table display responsive nowrap">
                    <thead>
                        <tr>
                            <th class="wd-5p">ID</th>
                            <th class="wd-10p">Coupon Code</th>
                            <th class="wd-10p">Image</th>
                            <th class="wd-10p">Discount(%)</th>
                            <th class="wd-5p">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($coupons as $key => $row)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $row->coupon }}</td>
                            <td><img src="{{ asset($row->image) }}" height="100px" width="100px"></td>
                            <td>{{ $row->discount }}%</td>
                            <td>
                                <a href="{{ URL::to('edit/coupon/'.$row->id) }}" class="btn btn-sm btn-info"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                <a href="{{ URL::to('delete/coupon/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> 
Delete</a>
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
                <h6 class="tx-14 mg-b-0 tx-uppercase tx-inverse tx-bold">Coupon Add</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('store.coupon') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body pd-20">

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Coupon Code</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required placeholder="Coupon" name="coupon" onkeyup="this.value = this.value.toUpperCase();">
                        @error('coupon')
                        <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Discount(%)</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required placeholder="Coupon Discount" name="discount">
                        @error('discount')
                        <span class="text text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Coupon Image</label>
                        <input type="file" class="form-control" aria-describedby="emailHelp"  name="image" required>
                        @error('image')
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