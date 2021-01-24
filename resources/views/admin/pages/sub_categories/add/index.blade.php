@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','SubCategories')
@section('styles')
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/bootstrap-summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jt.timepicker/jquery.timepicker.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/spectrum/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
    
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('vendors/css/bracket.css')}}">
    <link href="{{asset('vendors/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/css/float-labels.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- br-mainpanel -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Marj3</a>
            <a class="breadcrumb-item" href="{{route('admin.subcategories')}}">SubCategories</a>
            <span class="breadcrumb-item active">SubCategories Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">SubCategories Form</h4>
        <p class="mg-b-0">Forms are used to collect user information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="subcategory_form" method="post" enctype="multipart/form-data" data-parsley-validate>
            {{csrf_field()}}
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <div id="fnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">English Name</label>
                      <input class="form-control" type="text" name="translatedAttrs[en][name]" data-parsley-class-handler="#fnWrapper" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div id="lnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Arabic Name</label>
                      <input class="form-control" type="text" name="translatedAttrs[ar][name]" data-parsley-class-handler="#lnWrapper" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-4">
                <div class="d-flex">
                  <div id="slWrapper" class="parsley-select" style="width:100%">
                      <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <label class="control-label">Category</label>
                        <select class="form-control pmd-select2 select2-show-search" name="category_id" data-parsley-class-handler="#slWrapper"
                          data-parsley-errors-container="#slErrorContainer1" style="width:100%">
                          <option></option>
                          @foreach($categories as $category)
                            <option value="{{$category->id}}">{{$category->translate('en', true)->name}}</option>
                          @endforeach
                        </select>
                        <div id="slErrorContainer1"></div>
                      </div>
                    </div>
                  </div>
              </div>
            </div><!-- row -->
            <div class="form-layout-footer">
              <input type="submit" name="submit" id="action" value="Submit" class="btn btn-primary">
            </div><!-- form-layout-footer -->
            </form>
          </div><!-- form-layout -->
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->   
@endsection
@include('admin.pages.sub_categories.add.scripts')