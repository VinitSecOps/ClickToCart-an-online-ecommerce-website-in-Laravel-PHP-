@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <a class="breadcrumb-item" href="{{ url('all/blog/post') }}">Blog Post</a>
        <span class="breadcrumb-item active">Add Blog Post</span>
    </nav>

    <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">New Post Add
                <a href="{{ route('all.blog.post') }}" class="btn btn-sm btn-primary"
                                style="float: right;">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i> All Post
                            </a>
            </h6>

            <form method="POST" action="{{ route('store.post') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Post Title (ENGLISH): <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="post_title_english" placeholder="English" required>
                                @error('post_title_english')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Post Title (HINDI): <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="post_title_hindi" placeholder="हिंदी" required>
                                @error('post_title_hindi')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Post Title (GUJARATI): <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="post_title_gujarati" placeholder="ગુજરાતી" value="" required>
                                @error('post_title_gujarati')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-12">
                            <div class="form-group mg-b-10-force">
                                <label class="form-control-label">Blog Category: <span class="tx-danger">*</span></label>
                                <select class="form-control select2-show-search" data-placeholder="Choose Blog Category" name="category_id" required>
                                    <option label="Choose Blog Category"></option>
                                    @foreach($blog_categories as $row)
                                    <option value="{{ $row->id }}">{{ $row->category_name_english }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-12 -->



                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Details (ENGLISH): <span class="tx-danger">*</span></label>
                                <textarea class="form-control" name="deatils_english" id="summernote"></textarea>
                                @error('deatils_english')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-12 -->


                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Details (HINDI): <span class="tx-danger">*</span></label>
                                <textarea class="form-control" name="deatils_hindi" id="summernote_1"></textarea>
                                @error('deatils_hindi')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-12 -->


                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Post Details (GUJARATI): <span class="tx-danger">*</span></label>
                                <textarea class="form-control" name="deatils_gujarati" id="summernote_2"></textarea>
                                @error('deatils_gujarati')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-12 -->




                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Post Image: <span class="tx-danger">*</span></label>
                                <label class="custom-file">
                                    <input class="custom-file-input" type="file" id="file" name="post_image" onchange="readURL(this);" required>
                                    @error('post_image')
                                    <span class="text text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="custom-file-control"></span>
                                    <img src="#" id="one">
                                </label>

                            </div>
                        </div><!-- col-4 -->


                    </div><!-- row -->

                    <br><br>
                    <hr>



                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info mg-r-5"><i class="fa fa-plus" aria-hidden="true"></i>  
        Add</button>
                        <a href="{{ url('all/blog/post') }}" class="btn btn-secondary pd-x-20"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</a>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
        </div><!-- card -->
        </form>

    </div><!-- sl-mainpanel -->
</div>
<!-- ########## END: MAIN PANEL ########## -->


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

<script>
    $(function() {

        'use strict';

        // Select2 by showing the search
        $('.select2-show-search').select2({
            minimumResultsForSearch: ''
        });

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('select[name="category_id"]').on('change', function() {
            var category_id = $(this).val();
            if (category_id) {

                $.ajax({
                    url: "{{ url('/get/subcategory/') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value) {

                            $('select[name="subcategory_id"]').append('<option value="' + value.id + '">' + value.subcategory_name + '</option>');

                        });
                    },
                });

            } else {
                swal("", "Please Select a Category!", "warning");
            }

        });
    });
</script>

<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#one')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(150);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection