@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Student Grades')
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
            <span class="breadcrumb-item active">Student Grades Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Student Grades Form</h4>
        <p class="mg-b-0">Forms are used to collect Grades information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="grades_form" method="post" data-parsley-validate>
                {{csrf_field()}}
                <div class="table-wrapper">
                    <table id="grades_datatable" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Intake</th>
                                <th>Attendance 10%</th>
                                <th>Assignment 30%</th>
                                <th>Final Exam 60%</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $item)
                                <tr>
                                    <th><a href="{{ route('students.profile' , ['id' => $item->id]) }}">{{$item->name}} {{$item->last_name}} </a></th>
                                    <input type="hidden" name="grades[{{$loop->index}}][student_id]" value="{{$item->id}}">
                                    <input type="hidden" name="grades[{{$loop->index}}][program_intake_id]" value="{{$item->program_intake_id}}">
                                    <input type="hidden" name="grades[{{$loop->index}}][diplom_intake_id]" value="{{$item->diplom_intake_id}}">
                                    <th>@if($item->program_intake_id != null) {{$item->programintake->name}} @elseif($item->diplom_intake_id != null) {{$item->diplomintake->name}} @elseif($item->diplom_intake_id == null && $item->program_intake_id == null) Empty @endif</th>
                                    <!--<th>@if($item->status != null) {{$item->status}} @elseif($item->status == null) Empty @endif</th>-->
                                    <th><input style="width:77px;" type="text" class="form-control" name="grades[{{$loop->index}}][attendance]"></th>
                                    <th><input style="width:77px;" type="text" class="form-control" name="grades[{{$loop->index}}][assignment]"></th>
                                    <th><input style="width:77px;" type="text" class="form-control" name="grades[{{$loop->index}}][final_exam]"></th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><hr>
                <div class="row mg-b-25 align-items-center">
                    <div class="col-lg-4">
                        <div class="d-flex">
                            <div id="slWrapper" class="parsley-select" style="width: 100%;">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Doctor</label>
                                    <select class="form-control pmd-select2 select2-show-search" name="doctor_id" data-parsley-class-handler="#slWrapper"
                                            data-parsley-errors-container="#slErrorContainer" style="width: 100%;" required>
                                        <option></option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                        @endforeach
                                    </select>
                                    <div id="slErrorContainer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                    <label class="control-label">Diplom Course</label>
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