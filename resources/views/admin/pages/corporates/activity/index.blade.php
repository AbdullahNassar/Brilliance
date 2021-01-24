@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Corporate Activities')
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
            <a class="breadcrumb-item" href="{{route('admin.sales.leads')}}">Corporate Activities</a>
            <span class="breadcrumb-item active">Corporate Activities Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Corporate Activities Form</h4>
        <p class="mg-b-0">Forms are used to collect lead information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="activity_form" method="post" data-parsley-validate>
            {{csrf_field()}}
            <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
            <input type="hidden" name="corporate_id" value="{{$corporate->id}}">
            <div class="row mg-b-25">
              <div class="col-lg-6">
                <div class="form-group custom-inputfile" style="margin-left: 10px !important;">
                  <input type="file" name="proposal" id="file-6" class="inputfile inputfile-6">
                  <label for="file-6"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>Choose Proposal&hellip;</strong></label>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group custom-inputfile" style="margin-left: 10px !important;">
                  <input type="file" name="document" id="file-7" class="inputfile inputfile-6">
                  <label for="file-7"><span></span> <strong><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>Choose File&hellip;</strong></label>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="d-flex">
                  <div id="slWrapper" class="parsley-select" style="width:100%">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Status</label>
                      <select id="status" onchange="statusFunction()" class="form-control pmd-select2 select2-show-search" name="status" data-parsley-class-handler="#slWrapper"
                        data-parsley-errors-container="#slErrorContainer" style="width:100%" required>
                        <option> </option>
                        <option value="Follow Up">Follow Up</option>
                        <option value="Potential">Potential</option>
                        <option value="Hold">Hold</option>
                        <option value="No Answer">No Answer</option>
                        <option value="Interested">Interested</option>
                        <option value="Out Of Reach">Out Of Reach</option>
                        <option value="Closed">Closed</option>
                      </select>
                      <div id="slErrorContainer"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Next Date</label>
                      <input id="next_call" class="form-control datepicker dpd" type="text" name="next_call" data-date-format="dd-mm-yyyy" data-parsley-class-handler="#fnWrapper" required autocomplete="off" disabled>
                  </div>
                </div>
              </div>
              <div class="col-lg-2">
                <label class="control-label">Choose Service: </label>
              </div><!-- col-3 -->
              <div class="col-lg-2">
                <label class="rdiobox">
                  <input name="service" onclick="ShowHideDiv()" type="radio" id="program" value="Program">
                  <span>Program</span>
                </label>
              </div><!-- col-3 -->
              <div class="col-lg-2">
                <label class="rdiobox">
                  <input name="service" onclick="ShowHideDiv()" type="radio" id="diplom" value="Diploma">
                  <span>Diplom</span>
                </label>
              </div><!-- col-3 -->
              <div class="col-lg-2">
                <label class="rdiobox">
                  <input name="service" onclick="ShowHideDiv()" type="radio" id="training" value="Training">
                  <span>Training</span>
                </label>
              </div><!-- col-3 -->
              <div class="col-lg-2">
                <label class="rdiobox">
                  <input name="service" onclick="ShowHideDiv()" type="radio" id="consulting" value="Consulting">
                  <span>Consulting</span>
                </label>
              </div><!-- col-3 -->
              <br>
              <div class="col-lg-4">
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
              <div class="col-lg-4">
                <div class="d-flex">
                  <div id="slWrapper2" class="parsley-select" style="width:100%">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Diplom</label>
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
              <div class="col-lg-4">
                <div class="d-flex">
                  <div id="slWrapper3" class="parsley-select" style="width:100%">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Training</label>
                      <select id="training_list" class="form-control pmd-select2 select2-show-search" name="training_course_id" data-parsley-class-handler="#slWrapper3"
                          data-parsley-errors-container="#slErrorContainer3" style="width:100%" disabled>
                        <option></option>
                        @foreach($courses as $course)
                          <option value="{{$course->id}}">{{$course->name}}</option>
                        @endforeach
                      </select>
                      <div id="slErrorContainer3"></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div id="lnWrapper3" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Notes</label>
                      <textarea class="form-control" rows="7" type="text" name="notes" data-parsley-class-handler="#lnWrapper3" autocomplete="off"></textarea>
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
@include('admin.pages.corporates.activity.scripts')