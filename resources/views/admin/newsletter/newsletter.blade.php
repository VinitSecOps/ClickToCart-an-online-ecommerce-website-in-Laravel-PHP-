@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <span class="breadcrumb-item active">Newsletter</span>
    </nav>

    <div class="sl-pagebody">
        <div class="sl-page-title">
            <h5>Subscriber Table
                <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                </a>
            </h5>

        </div><!-- sl-page-title -->

        <form>
            @csrf
            @method('DELETE')
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Subscriber List
                    
                    <button type="submit" formaction="{{ url('delete/selected/newsletter') }}" class="btn btn-sm btn-warning" style="float: right;"><i class="fa fa-minus-square" aria-hidden="true"></i> Delete selected</button>
                </h6>


                <div class="table-wrapper">
                    <table id="datatable1" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th width="1%"></th>
                                <th>ID</th>
                                <th>Email</th>
                                <th>Subscription time</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($newsletters as $key => $row)
                            <tr>
                                <td><input type="checkbox" name="ids[]" value="{{ $row->id }}"></td>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ \Carbon\Carbon::parse($row->created_at)->diffForHumans() }}</td>
                                <td>

                                    <a href="{{ URL::to('delete/newsletter/'.$row->id) }}" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- table-wrapper -->
            </div><!-- card -->
        </form>
    </div><!-- sl-mainpanel -->
</div>
<!-- ########## END: MAIN PANEL ########## -->


@endsection