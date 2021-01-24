@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Marketing Leads')
@section('styles')
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/bootstrap-summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
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
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Brilliance</a>
            <a class="breadcrumb-item" href="{{route('admin.marketing.leads')}}">Marketing Leads</a>
            <span class="breadcrumb-item active">Marketing Leads Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Marketing Leads Form</h4>
        <p class="mg-b-0">Forms are used to collect lead information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="lead_form" method="post" data-parsley-validate>
            {{csrf_field()}}
            <input type="hidden" name="marketing_id" value="{{Auth::user()->id}}">
            <div class="row mg-b-25">
              <!--<div class="col-lg-6">
                <div id="fnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Created Time</label>
                      <input class="form-control datepicker dpd" value="{{$lead->created_time}}" type="text" name="created_time" data-date-format="dd-mm-yyyy" data-parsley-class-handler="#fnWrapper" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="lnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Campaign Name</label>
                      <input class="form-control" type="text" value="{{$lead->campaign_name}}" name="campaign_name" data-parsley-class-handler="#lnWrapper" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper1" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Form Name</label>
                      <input class="form-control" type="text" value="{{$lead->form_name}}" name="form_name" data-parsley-class-handler="#fnWrapper1" required autocomplete="off">
                  </div>
                </div>
              </div>-->
              <div class="col-lg-6">
                <div id="fnWrapper2" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Full Name</label>
                      <input class="form-control" type="text" value="{{$lead->full_name}}" name="full_name" data-parsley-class-handler="#fnWrapper2" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="lnWrapper3" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Phone Number</label>
                      <input class="form-control" type="text" value="{{$lead->phone_number}}" name="phone_number" data-parsley-class-handler="#lnWrapper3" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper4" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Email</label>
                      <input class="form-control" type="email" value="{{$lead->email}}" name="email" data-parsley-class-handler="#fnWrapper4" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper3" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Company Name</label>
                      <input class="form-control" type="text" value="{{$lead->company_name}}" name="company_name" data-parsley-class-handler="#fnWrapper3" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="lnWrapper2" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Job Title</label>
                      <input class="form-control" type="text" value="{{$lead->job_title}}" name="job_title" data-parsley-class-handler="#lnWrapper2" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="lnWrapper1" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Platform</label>
                      <input class="form-control" type="text" value="{{$lead->platform}}" name="platform" data-parsley-class-handler="#lnWrapper1" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-layout-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div><!-- form-layout-footer -->
              </div>
            </form>
          </div><!-- form-layout -->
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->   
@endsection
@include('admin.pages.marketing.edit.scripts')