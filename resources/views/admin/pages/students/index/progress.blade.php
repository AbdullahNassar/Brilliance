@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Student Progress')
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
            <a class="breadcrumb-item" href="{{route('admin.students')}}">Students</a>
            <span class="breadcrumb-item active">Student Progress Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Student Progress Form</h4>
        <p class="mg-b-0">Forms are used to collect progress information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
        <h4 style="color:#000;">Student Name : {{$student->name}} {{$student->middle_name}} {{$student->last_name}}</h4>
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="progress_form" method="post" data-parsley-validate>
                {{csrf_field()}}
                <input type="hidden" value="{{$student->id}}" name="student_id">
                <div class="row mg-b-25 align-items-center">
                    <div class="col-lg-4">
                        <div class="d-flex">
                            <div id="slWrapper5" class="parsley-select" style="width:100%">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Program Course</label>
                                    <select class="form-control pmd-select2 select2-show-search" name="program_course_id" data-parsley-class-handler="#slWrapper5"
                                        data-parsley-errors-container="#slErrorContainer5" style="width:100%">
                                      <option></option>
                                      @foreach($program_courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                      @endforeach
                                    </select>
                                    <div id="slErrorContainer5"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex">
                            <div id="slWrapper7" class="parsley-select" style="width:100%">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                                    <label class="control-label">Diploma Course</label>
                                    <select class="form-control pmd-select2 select2-show-search" name="diplom_course_id" data-parsley-class-handler="#slWrapper7"
                                        data-parsley-errors-container="#slErrorContainer7" style="width:100%">
                                      <option></option>
                                      @foreach($diplom_courses as $course)
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                      @endforeach
                                    </select>
                                    <div id="slErrorContainer7"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="d-flex">
                            <div id="slWrapper1" class="parsley-select" style="width: 100%;">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Status</label>
                                    <select class="form-control pmd-select2 select2-show-search" name="status" data-parsley-class-handler="#slWrapper1"
                                            data-parsley-errors-container="#slErrorContainer1" style="width: 100%;" required>
                                        <option> </option>
                                        <option value="Pending">Pending</option>
                                        <option value="Completed">Completed</option>
                                        <option value="Failed">Failed</option>
                                        <option value="No Show Course">No Show Course</option>
                                        <option value="No Show Exam">No Show Exam</option>
                                        <option value="Excuse">Withdraw</option>
                                        <option value="Waived">Waived</option>
                                    </select>
                                    <div id="slErrorContainer1"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div id="lnWrapper88" class="parsley-input">
                            <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                <label class="control-label">Notes</label>
                                <textarea class="form-control" name="notes" data-parsley-class-handler="#lnWrapper88" autocomplete="off"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary center">Save</button>
                    </div>
                </div>
            </form>
          </div><!-- form-layout -->
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->   
@endsection
@include('admin.pages.students.index.scripts')