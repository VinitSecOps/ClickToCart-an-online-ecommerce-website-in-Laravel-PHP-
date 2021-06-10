@extends('admin.admin_layouts')

@section('admin_content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('admin/home') }}">ClickToCart</a>
        <span class="breadcrumb-item active">SEO Setting</span>
    </nav>

    <div class="sl-pagebody">

        <div class="card pd-20 pd-sm-40">
            <h6 class="card-body-title">Update SEO Settings
                <a href="{{ url('admin/home') }}" class="btn btn-sm btn-primary" style="float: right;">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> BACK TO DASHBOARD
                </a>
            </h6>

            <form method="POST" action="{{ route('update.seo') }}">
                @csrf
                <div class="form-layout">
                    <div class="row mg-b-25">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Meta Title: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="meta_title" value="{{ $seo->meta_title }}" required>
                                @error('meta_title')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-4 -->
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Meta Author: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="meta_author" value="{{ $seo->meta_author }}" required>
                                @error('meta_author')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-4 -->

                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Meta Tags: <span class="tx-danger">*</span></label>
                                <input class="form-control" type="text" name="meta_tag"  value="{{ $seo->meta_tag }}" required>
                                @error('meta_tag')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-4 -->

            



                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Meta Description: <span class="tx-danger">*</span></label>
                                <textarea class="form-control" name="meta_description">{{ $seo->meta_description }}</textarea>
                                @error('meta_description')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-12 -->


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Google Analytics: <span class="tx-danger">*</span></label>
                                <textarea class="form-control" name="google_analytics" >{{ $seo->google_analytics }}</textarea>
                                @error('google_analytics')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-12 -->


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label">Bing Analytics: <span class="tx-danger">*</span></label>
                                <textarea class="form-control" name="bing_analytics" >{{ $seo->bing_analytics }}</textarea>
                                @error('bing_analytics')
                                <span class="text text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div><!-- col-12 -->

                    </div><!-- row -->


                    <input type="hidden" name="id" value="{{ $seo->id }}">

                    <div class="form-layout-footer">
                        <button type="submit" class="btn btn-info mg-r-5"><i class="fa fa-history" aria-hidden="true"></i> Update</button>
                        <a href="{{ url('admin/home') }}" class="btn btn-secondary pd-x-20"><i class="fa fa-times-circle" aria-hidden="true"></i> Close</a>
                    </div><!-- form-layout-footer -->
                </div><!-- form-layout -->
        </div><!-- card -->
        </form>

    </div><!-- sl-mainpanel -->
</div>
<!-- ########## END: MAIN PANEL ########## -->




@endsection