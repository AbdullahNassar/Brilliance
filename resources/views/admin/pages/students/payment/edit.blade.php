@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Edit Student Payment Plan')
@section('styles')
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/bootstrap-summernote/summernote.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/select2/css/select2.min.css')}}" rel="stylesheet">
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
@php $key = 0; @endphp
@section('content')
    <!-- br-mainpanel -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Brilliance</a>
            <a class="breadcrumb-item" href="{{route('admin.students')}}">Students</a>
            <span class="breadcrumb-item active">Edit Student Payment Plan Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Edit Student Payment Plan Form</h4>
        <p class="mg-b-0">Forms are used to collect payment plan information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
        <h4 style="color:#000;">Student Name : {{$pay->student->name}} {{$pay->student->middle_name}} {{$pay->student->last_name}}</h4>
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="pay_form" method="post" data-parsley-validate>
            {{csrf_field()}}
            <input type="hidden" value="{{$pay->id}}" name="pay_id">
              <div class="row mg-b-25">
                <div class="col-lg-3">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Date</label>
                    <input type="text" value="{{$pay->date}}" class="form-control datepicker dpd" name="date" autocomplete="off">
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Euro = EGP</label>
                    <input type="number" value="{{$pay->egp_amount}}" class="form-control" name="egp_amount" autocomplete="off">
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">Euro</label>
                    <input type="number" value="{{$pay->euro_amount}}" class="form-control" name="euro_amount" autocomplete="off">
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                    <label class="control-label">USD</label>
                    <input type="number" value="{{$pay->usd_amount}}" class="form-control" name="usd_amount" autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="row mg-b-25">
                <div class="col-lg-12">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </form>
          </div><!-- form-layout -->
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->   
@endsection
@include('admin.pages.students.payment.scripts')