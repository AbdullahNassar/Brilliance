@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Sales Tickets')
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
@section('content')
    <!-- br-mainpanel -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Brilliance</a>
            <a class="breadcrumb-item" href="{{route('admin.tickets')}}">Sales Tickets</a>
            <span class="breadcrumb-item active">Sales Tickets Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Sales Tickets Form</h4>
        <p class="mg-b-0">Forms are used to collect ticket information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="ticket_form" method="post" data-parsley-validate>
            {{csrf_field()}}
            <input type="hidden" name="sales_id" value="{{Auth::user()->id}}">
            <div class="row mg-b-25">
              <div class="col-lg-4">
                <label class="control-label">Choose: </label>
              </div><!-- col-3 -->
              <div class="col-lg-4">
                <label class="rdiobox">
                  <input name="choose" onclick="ShowHideDiv()" type="radio" id="program" value="program">
                  <span>Program</span>
                </label>
              </div><!-- col-3 -->
              <div class="col-lg-4">
                <label class="rdiobox">
                  <input name="choose" onclick="ShowHideDiv()" type="radio" id="diplom" value="diplom">
                  <span>Diplom</span>
                </label>
              </div><!-- col-3 -->
              <br>
              <div class="col-lg-6">
                <div class="d-flex">
                  <div id="slWrapper1" class="parsley-select" style="width:100%">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Program</label>
                      <select id="program_list" class="form-control pmd-select2 select2-show-search" name="program_id" data-parsley-class-handler="#slWrapper1"
                          data-parsley-errors-container="#slErrorContainer1" style="width:100%" disabled>
                        <option></option>
                        @foreach($programs as $program)
                          <option value="{{$program->id}}">{{$program->name}}</option>
                        @endforeach
                      </select>
                      <div id="slErrorContainer1"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="d-flex">
                  <div id="slWrapper2" class="parsley-select" style="width:100%">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Diploma</label>
                      <select id="diplom_list" class="form-control pmd-select2 select2-show-search" name="diplom_id" data-parsley-class-handler="#slWrapper2"
                          data-parsley-errors-container="#slErrorContainer2" style="width:100%" disabled>
                        <option></option>
                        @foreach($diploms as $diplom)
                          <option value="{{$diplom->id}}">{{$diplom->name}}</option>
                        @endforeach
                      </select>
                      <div id="slErrorContainer2"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper1" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Source</label>
                      <input class="form-control" type="text" name="source" data-parsley-class-handler="#fnWrapper1" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="lnWrapper1" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Previous Study</label>
                      <input class="form-control" type="text" name="study" data-parsley-class-handler="#lnWrapper1" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper2" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Full Name</label>
                      <input class="form-control" type="text" name="full_name" data-parsley-class-handler="#fnWrapper2" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="lnWrapper2" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Job Title</label>
                      <input class="form-control" type="text" name="job_title" data-parsley-class-handler="#lnWrapper2" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper3" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Company Name</label>
                      <input class="form-control" type="text" name="company_name" data-parsley-class-handler="#fnWrapper3" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="lnWrapper3" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Phone Number</label>
                      <input class="form-control" type="text" name="phone_number" data-parsley-class-handler="#lnWrapper3" required autocomplete="off">
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper4" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Email</label>
                      <input class="form-control" type="email" name="email" data-parsley-class-handler="#fnWrapper4" required autocomplete="off">
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
@include('admin.pages.sales.ticket.add.scripts')