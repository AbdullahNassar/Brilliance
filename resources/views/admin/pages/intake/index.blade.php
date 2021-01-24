@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Intake Profile')
@section('styles')
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <!-- Bracket CSS -->
    <link href="{{asset('vendors/toastr/toastr.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('vendors/css/bracket.css')}}">
    <link href="{{asset('vendors/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/css/float-labels.css')}}" rel="stylesheet">
@endsection
@section('content')
      <div class="card shadow-base bd-0 rounded-0 widget-4">
        <div class="card-header ht-75">
          <!--<div class="hidden-xs-down">
            <a href="" class="mg-r-10"><span class="tx-medium">498</span> Followers</a>
            <a href=""><span class="tx-medium">498</span> Following</a>
          </div>
          <div class="tx-24 hidden-xs-down">
            <a href="" class="mg-r-10"><i class="icon ion-ios-email-outline"></i></a>
            <a href=""><i class="icon ion-more"></i></a>
          </div>-->
        </div><!-- card-header -->
        <div class="card-body">
          <div class="card-profile-img">
            <img src="{{asset('vendors/img/lead.jpg')}}" alt="lead">
          </div><!-- card-profile-img -->
          <h4 class="tx-normal tx-roboto tx-white">{{$intake->name}}</h4>
          @if($intake->program != null)
          <h6 class="tx-normal tx-roboto tx-white">{{$intake->program->name}} - {{$intake->program->university->name}}</h6>
          @elseif($intake->diplom != null)
          <h6 class="tx-normal tx-roboto tx-white">{{$intake->diplom->name}} - {{$intake->diplom->university->name}}</h6>
          @endif
        </div><!-- card-body -->
      </div><!-- card -->

      <div class="tab-content br-profile-body">
        <div class="tab-pane fade active show">
          <div class="row">
            <div class="col-lg-12">
              <div class="media-list bg-white rounded shadow-base">
                <div class="br-section-wrapper">
                  <div class="table-wrapper">
                    <table id="students_datatable" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Corporate</th>
                                <th>Mobile</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($students as $item)
                                <tr>
                                    <th>{{$loop->index +1}}</th>
                                    <th>
                                    @if($item->image != null)
                                    <img src="{{asset('images/users').'/'.$item->image}}" alt="" class="wd-40 rounded-circle">
                                    @else
                                    <img src="{{asset('vendors/img/lead.jpg')}}" alt="lead" class="wd-40 rounded-circle">
                                    @endif
                                    </th>
                                    <th><a href="{{ route('students.profile' , ['id' => $item->id]) }}">{{$item->name}} {{$item->last_name}} </a></th>
                                    <th>{{$item->corporate->name}}</th>
                                    <th>{{$item->mobile1}}</th>
                                    <th>{{$item->email1}}</th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div><!-- table-wrapper -->
              </div><!-- card -->
            </div><!-- col-lg-12 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
        <br> <br>
        <div class="tab-pane fade active show">
          <div class="row">
          
            <div class="col-lg-12">
              <div class="media-list bg-white rounded shadow-base">
                <div class="br-section-wrapper">
                <h4 style="text-align:center; color:#000;">Students Grades Form</h4>
                  <div class="table-wrapper">
                  <form @if($intake->program != null) id="program_grades_form" @elseif($intake->diplom != null) id="diplom_grades_form" @endif method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <table id="grades_datatable" class="table display responsive nowrap">
                        <thead>
                            <tr>
                                <th>Student Name</th>
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
                                    <th><input style="width:77px;" type="text" class="form-control" name="grades[{{$loop->index}}][attendance]"></th>
                                    <th><input style="width:77px;" type="text" class="form-control" name="grades[{{$loop->index}}][assignment]"></th>
                                    <th><input style="width:77px;" type="text" class="form-control" name="grades[{{$loop->index}}][final_exam]"></th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
                </div><!-- table-wrapper -->
                    <div class="form-layout form-layout-1">
                        <div class="row" style="padding:25px;">
                            <div class="col-lg-6">
                                <div class="form-group pmd-textfield pmd-textfield-floating-label">
                                    <label class="control-label">Select Course</label>
                                    <select class="form-control select2-show-search" name="course_id">
                                        <option></option>
                                        @foreach($courses as $course)
                                            <option value="{{$course->id}}">{{$course->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
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
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <button class="btn btn-oblong btn-outline-primary mg-b-10 float-right" type="submit">Save Grades</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
              </div><!-- card -->
            </div><!-- col-lg-12 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
      </div><!-- br-pagebody -->
@endsection
@include('admin.pages.intake.scripts')