@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Students Attendance')
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
@php $key = 0; @endphp
@section('content')
    <!-- br-mainpanel -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Brilliance</a>
            <a class="breadcrumb-item" href="{{route('admin.students')}}">Students</a>
            <span class="breadcrumb-item active">Student Attendance Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Student Attendance Form</h4>
        <p class="mg-b-0">Forms are used to collect Grades information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="attendance_form" method="post" data-parsley-validate>
                {{csrf_field()}}
                <div class="row mg-b-25 align-items-center schedule">
                    <div class="col-lg-6" id="remove_schedule2">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label class="control-label">Date</label>
                            <input id="date" type="text" class="form-control datepicker dpd" name="schedules[{{$key}}][date]" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div id="slWrapper8" class="parsley-select" style="width: 100%;">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Doctor</label>
                                    <select id="doctor_id" class="form-control pmd-select2 select2-show-search" name="doctor_id" data-parsley-class-handler="#slWrapper8"
                                            data-parsley-errors-container="#slErrorContainer8" style="width: 100%;" >
                                        <option></option>
                                            @foreach($doctors as $doctor)
                                                <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                            @endforeach
                                    </select>
                                    <div id="slErrorContainer8"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mg-b-25">
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
                        <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                            <label class="control-label">Program</label>
                            <select id="program_list" onchange="programFunction()" class="form-control pmd-select2 select2-show-search" name="program_id" data-parsley-class-handler="#slWrapper1"
                                data-parsley-errors-container="#slErrorContainer1" style="width:100%" disabled>
                            <option></option>
                            </select>
                            <div id="slErrorContainer1"></div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="d-flex">
                        <div id="slWrapper2" class="parsley-select" style="width:100%">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                            <label class="control-label">Diplom</label>
                            <select id="diplom_list" onchange="diplomFunction()" class="form-control pmd-select2 select2-show-search" name="diplom_id" data-parsley-class-handler="#slWrapper2"
                                data-parsley-errors-container="#slErrorContainer2" style="width:100%" disabled>
                            <option></option>
                            </select>
                            <div id="slErrorContainer2"></div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-4">
                    <div class="d-flex">
                        <div id="slWrapper3" class="parsley-select" style="width:100%">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                            <label class="control-label">Training</label>
                            <select id="training_list" class="form-control pmd-select2 select2-show-search" name="training_course_id" data-parsley-class-handler="#slWrapper3"
                                data-parsley-errors-container="#slErrorContainer3" style="width:100%" disabled>
                            <option></option>
                            </select>
                            <div id="slErrorContainer3"></div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-4" style="display:none;" id="program_courses">
                    <div class="d-flex">
                        <div id="slWrapper5" class="parsley-select" style="width:100%">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                            <label class="control-label">Program Course</label>
                            <select id="program_course" class="form-control pmd-select2 select2-show-search" name="program_course_id" data-parsley-class-handler="#slWrapper5"
                                data-parsley-errors-container="#slErrorContainer5" style="width:100%" disabled>
                            <option></option>
                            </select>
                            <div id="slErrorContainer5"></div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-4" style="display:none;" id="diplom_courses">
                    <div class="d-flex">
                        <div id="slWrapper7" class="parsley-select" style="width:100%">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                            <label class="control-label">Diplom Course</label>
                            <select id="diplom_course" class="form-control pmd-select2 select2-show-search" name="diplom_course_id" data-parsley-class-handler="#slWrapper7"
                                data-parsley-errors-container="#slErrorContainer7" style="width:100%" disabled>
                            <option></option>
                            </select>
                            <div id="slErrorContainer7"></div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-12">
                        <a id="search" onclick="searchFunction()" class="btn btn-primary center">Search</a>
                    </div>
                </div><hr>
                <div class="table-wrapper">
                    <table id="attendance_datatable" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>
                                    Attendance
                                </th>
                                <th>Full Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody id="attendance_data">
                            @foreach($students as $item)
                                <tr>
                                    <th><label class="ckbox"><input id="ckbox{{$item->id}}" name="check{{$item->id}}" type="checkbox"><span> </span></label><input value="{{$item->id}}" id="checked{{$item->id}}" name="checked{{$item->id}}" type="hidden"></th>
                                    <th><a href="{{ route('students.profile' , ['id' => $item->id]) }}">{{$item->name}} {{$item->middle_name}} {{$item->last_name}}</a></th>
                                    <th>{{$item->mobile1}}</th>
                                    <th>{{$item->email1}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><hr>
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-primary center">Save</button>
                </div>
            </form>
          </div><!-- form-layout -->
        </div><!-- br-section-wrapper -->
      </div><!-- br-pagebody -->   
@endsection
@include('admin.pages.students.index.scripts')