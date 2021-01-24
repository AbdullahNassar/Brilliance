@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Student Schedule')
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
            <span class="breadcrumb-item active">Student Schedule Form</span>
        </nav>
      </div><!-- br-pageheader -->
      <div class="pd-x-20 pd-sm-x-30 pd-t-20 pd-sm-t-30">
        <h4 class="tx-gray-800 mg-b-5">Student Schedule Form</h4>
        <p class="mg-b-0">Forms are used to collect Grades information with different element types of input, select, checkboxes, radios and more.</p>
      </div>

      <div class="br-pagebody">
        <div class="br-section-wrapper">
          <div class="form-layout form-layout-1">
            <form class="parsley-style-1" id="schedules_form" method="post" data-parsley-validate>
                {{csrf_field()}}
                <div class="table-wrapper">
                    <table id="schedules_datatable" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>
                                    #
                                </th>
                                <th>Full Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Intake</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $item)
                                <tr>
                                    <th>
                                        <label class="ckbox">
                                            <input id="ckbox{{$item->id}}" name="check{{$item->id}}" type="checkbox">
                                            <span> </span>
                                        </label>
                                        <input value="{{$item->id}}" id="checked{{$item->id}}" name="checked{{$item->id}}" type="hidden">
                                    </th>
                                    <th><a href="{{ route('students.profile' , ['id' => $item->id]) }}">{{$item->name}} {{$item->middle_name}} {{$item->last_name}}</a></th>
                                    <th>{{$item->mobile1}}</th>
                                    <th>{{$item->email1}}</th>
                                    <th>@if($item->program_intake_id != null) {{$item->programintake->name}} @elseif($item->diplom_intake_id != null) {{$item->diplomintake->name}} @else Empty @endif</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><hr>
                <div class="row mg-b-25 align-items-center schedule">
                    <div class="col-lg-3" id="remove_schedule1">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label class="control-label">Type</label>
                            <select class="form-control" name="schedules[{{$key}}][type]">
                                <option></option>
                                <option value="Lecture 1">Lecture 1</option>
                                <option value="Lecture 2">Lecture 2</option>
                                <option value="Lecture 3">Lecture 3</option>
                                <option value="Lecture 4">Lecture 4</option>
                                <option value="Lecture 5">Lecture 5</option>
                                <option value="Lecture 6">Lecture 6</option>
                                <option value="Lecture 7">Lecture 7</option>
                                <option value="Lecture 8">Lecture 8</option>
                                <option value="Lecture 9">Lecture 9</option>
                                <option value="Lecture 10">Lecture 10</option>
                                <option value="Lecture 11">Lecture 11</option>
                                <option value="Lecture 12">Lecture 12</option>
                                <option value="Final Exam">Final Exam</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-3" id="remove_schedule2">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label class="control-label">Date</label>
                            <input type="text" class="form-control datepicker dpd" name="schedules[{{$key}}][date]" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-2" id="remove_schedule3">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label class="control-label">Time From</label>
                            <input id="tpBasic0" type="text" class="form-control" name="schedules[{{$key}}][time_from]" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-2" id="remove_schedule4">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label class="control-label">Time To</label>
                            <input id="tpBasic1" type="text" class="form-control" name="schedules[{{$key}}][time_to]" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-lg-2">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <input type="hidden" class="form-control" name="num3" id="num3"  value="1"/>
                        <a class="btn btn-outline-primary add_form_field3"><i class="fa fa-plus"></i> Add</a>
                    </div>
                    </div>
                    <div id="old_remove_schedule_button" class="col-lg-12">
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
                        <input name="service" onclick="ShowHideDiv()" type="radio" id="consulting" value="Consulting">
                        <span>Consulting</span>
                    </label>
                    </div><!-- col-3 -->
                    <div class="col-lg-2">
                    <label class="rdiobox">
                        <input name="service" onclick="ShowHideDiv()" type="radio" id="training" value="Training">
                        <span>Training</span>
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
                    <div class="col-lg-6" style="display:none;" id="program_intakes">
                    <div class="d-flex">
                        <div id="slWrapper4" class="parsley-select" style="width:100%">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                            <label class="control-label">Program Intake</label>
                            <select id="program_intake" class="form-control pmd-select2 select2-show-search" name="program_intake_id" data-parsley-class-handler="#slWrapper4"
                                data-parsley-errors-container="#slErrorContainer4" style="width:100%" disabled>
                            <option></option>
                            </select>
                            <div id="slErrorContainer4"></div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6" style="display:none;" id="program_courses">
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
                    <div class="col-lg-6" style="display:none;" id="diplom_intakes">
                    <div class="d-flex">
                        <div id="slWrapper6" class="parsley-select" style="width:100%">
                        <div class="form-group pmd-textfield pmd-textfield-floating-label select_data">
                            <label class="control-label">Diplom Intake</label>
                            <select id="diplom_intake" class="form-control pmd-select2 select2-show-search" name="diplom_intake_id" data-parsley-class-handler="#slWrapper6"
                                data-parsley-errors-container="#slErrorContainer6" style="width:100%" disabled>
                            <option></option>
                            </select>
                            <div id="slErrorContainer6"></div>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6" style="display:none;" id="diplom_courses">
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
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div id="slWrapper8" class="parsley-select" style="width: 100%;">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Doctor</label>
                                    <select class="form-control pmd-select2 select2-show-search" name="doctor_id" data-parsley-class-handler="#slWrapper8"
                                            data-parsley-errors-container="#slErrorContainer8" style="width: 100%;" required>
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
                    <div class="col-lg-6">
                        <div class="d-flex">
                            <div id="slWrapper88" class="parsley-select" style="width: 100%;">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Hall</label>
                                    <select class="form-control pmd-select2 select2-show-search" name="hall_id" data-parsley-class-handler="#slWrapper88"
                                    data-parsley-errors-container="#slErrorContainer88" style="width: 100%;" required>
                                    <option></option>
                                    @foreach($halls as $hall)
                                        <option value="{{$hall->id}}">{{$hall->name}}</option>
                                    @endforeach
                                    </select>
                                    <div id="slErrorContainer88"></div>
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