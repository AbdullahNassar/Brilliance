@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Students')
@section('styles')
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('vendors/css/bracket.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/fullcalendar/lib/main.css')}}">
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
          @if($student->image != null) 
            <img src="{{asset('images/users').'/'.$student->image}}" alt="Student">
          @else
            <img src="{{asset('vendors/img/lead.jpg')}}" alt="lead">
          @endif
          </div><!-- card-profile-img -->
          <h4 class="tx-normal tx-roboto tx-white">{{$student->name}} {{$student->middle_name}} {{$student->last_name}}</h4>
          <h6 class="tx-normal tx-roboto tx-white">{{$student->job}} @if($student->corporate_id != null) - {{$student->corporate->name}} @endif</h6>
          <h6 class="tx-normal tx-roboto tx-white">@if($student->program_id != null) {{$student->program->name}} - {{$student->program->university->name}} - @endif @if($student->diplom_id != null) {{$student->diplom->name}} - {{$student->diplom->university->name}} - @endif  @if($student->program_intake_id != null) {{$student->programintake->name}} @endif  @if($student->diplom_intake_id != null) {{$student->diplomintake->name}} @endif</h6>
          <p class="tx-normal tx-roboto tx-white"><a style="color:#fff;" target="_blank" href="{{ route('students.schedule' , ['id' => $student->id]) }}" title="Student Schedule"><i class="fa fa-calendar"></i></a></p>

          <!--<p class="mg-b-0 tx-24">
            <a href="" class="tx-white-8 mg-r-5"><i class="fa fa-facebook-official"></i></a>
            <a href="" class="tx-white-8 mg-r-5"><i class="fa fa-twitter"></i></a>
            <a href="" class="tx-white-8 mg-r-5"><i class="fa fa-linkedin"></i></a>
            <a href="" class="tx-white-8"><i class="fa fa-instagram"></i></a>
          </p>-->
        </div><!-- card-body -->
      </div><!-- card -->

      <div class="ht-70 bg-gray-100 pd-x-20 d-flex align-items-center justify-content-center shadow-base">
        <ul class="nav nav-outline active-info align-items-center flex-row" role="tablist">
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#info" role="tab">Schedule</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#work" role="tab">Student Data</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#grades" role="tab">Grades</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#progress" role="tab">Progress</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#payment" role="tab">Transactions</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#plan" role="tab">Payment Plan</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#documents" role="tab">Documents</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#graduation" role="tab">Graduation</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#communicate" role="tab">Messeges</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#log" role="tab">Activities</a></li>
        </ul>
      </div>

      <div class="tab-content br-profile-body">
        <div class="tab-pane fade active show" id="info">
          <div class="row">
            <div class="col-lg-12">
              <div class="media-list bg-white rounded shadow-base">
                
                  <div id="accordion" class="accordion" role="tablist" aria-multiselectable="true">
                    @if($student->program_id != null)
                    @foreach($student->program->courses as $course)
                    <div class="card">
                        <div class="card-header" role="tab" id="heading{{$course->id}}">
                            <h6 class="mg-b-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$course->id}}" aria-expanded="true" aria-controls="collapse{{$course->id}}" class="tx-gray-800 transition  collapsed"
                                style="background-color: #e9ecef; color: #000;">
                                  {{$course->name}} | {{$course->program->name}} | {{$course->program->university->name}}
                                </a>
                            </h6>
                        </div>
                        <!-- card-header -->

                        <div id="collapse{{$course->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$course->id}}" style="background-color: #fff; color: #000;">
                            <div class="card-block pd-20">
                                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                                  <div class="bd bd-gray-300 rounded table-responsive">
                                    <table class="table mg-b-0">
                                      <thead>
                                        <tr>
                                          <th>Type</th>
                                          <th>Date</th>
                                          <th>Time</th>
                                          <th>Program</th>
                                          <th>Course</th>
                                          <th>Intake</th>
                                          <th>Doctor</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @if($student->studentSchedules != null) 
                                      @foreach($student->studentSchedules as $schedule)
                                      @if($schedule->program_course_id == $course->id)
                                        <tr>
                                          <th>{{$schedule->type}}</th>
                                          <th>{{$schedule->date}}</th>
                                          <th>from {{$schedule->time_from}} to {{$schedule->time_to}}</th>
                                          @if($schedule->program_id != null)
                                          <th>{{$schedule->program->name}} | {{$schedule->program->university->name}}</th>
                                          <th>{{$schedule->programCourse->name}}</th>
                                          <th>{{$schedule->programIntake->name}}</th>
                                          @endif
                                          <th>@if($schedule->doctor_id != null) {{$schedule->doctor->name}} @else Empty @endif</th>
                                        </tr>
                                      @endif
                                      @endforeach
                                      @endif
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <!-- col-4 -->
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    @endforeach
                    @endif
                    @if($student->diplom_id != null)
                    @foreach($student->diplom->courses as $course)
                    <div class="card">
                        <div class="card-header" role="tab" id="heading{{$course->id}}">
                            <h6 class="mg-b-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$course->id}}" aria-expanded="true" aria-controls="collapse{{$course->id}}" class="tx-gray-800 transition collapsed">
                                  {{$course->name}}
                                </a>
                            </h6>
                        </div>
                        <!-- card-header -->

                        <div id="collapse{{$course->id}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$course->id}}" style="background-color: #fff; color: #000;">
                            <div class="card-block pd-20">
                                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                                  <div class="bd bd-gray-300 rounded table-responsive">
                                    <table class="table mg-b-0">
                                      <thead>
                                        <tr>
                                          <th>Type</th>
                                          <th>Date</th>
                                          <th>Time</th>
                                          <th>Program</th>
                                          <th>Course</th>
                                          <th>Intake</th>
                                          <th>Doctor</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @if($student->studentSchedules != null) 
                                      @foreach($student->studentSchedules as $schedule)
                                      @if($schedule->diplom_course_id == $course->id)
                                        <tr>
                                          <th>{{$schedule->type}}</th>
                                          <th>{{$schedule->date}}</th>
                                          <th>from {{$schedule->time_from}} to {{$schedule->time_to}}</th>
                                          @if($schedule->diplom_id != null)
                                          <th>{{$schedule->diplom->name}} | {{$schedule->diplom->university->name}}</th>
                                          <th>{{$schedule->diplomCourse->name}}</th>
                                          <th>{{$schedule->diplomIntake->name}}</th>
                                          @endif
                                          @if($schedule->program_id == null && $schedule->diplom_id == null && $schedule->training_course_id == null)
                                          <th>{{$schedule->service}}</th>
                                          <th>   </th>
                                          @endif
                                          <th>@if($schedule->doctor_id != null) {{$schedule->doctor->name}} @else Empty @endif</th>
                                        </tr>
                                      @endif
                                      @endforeach
                                      @endif
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <!-- col-4 -->
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    @endforeach
                    @endif
                    <div class="card">
                        <div class="card-header" role="tab" id="headingOne">
                            <h6 class="mg-b-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="tx-gray-800 transition collapsed"
                                  style="background-color: #e9ecef; color: #000;">
                                  Training
                                </a>
                            </h6>
                        </div>
                        <!-- card-header -->

                        <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" style="background-color: #fff; color: #000;">
                            <div class="card-block pd-20">
                                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                                  <div class="bd bd-gray-300 rounded table-responsive">
                                    <table class="table mg-b-0">
                                      <thead>
                                        <tr>
                                          <th>Type</th>
                                          <th>Date</th>
                                          <th>Time</th>
                                          <th>Program</th>
                                          <th>Course</th>
                                          <th>Intake</th>
                                          <th>Doctor</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @if($student->studentSchedules != null) 
                                      @foreach($student->studentSchedules as $schedule)
                                      @if($schedule->training_course_id != null)
                                        <tr>
                                          <th>{{$schedule->type}}</th>
                                          <th>{{$schedule->date}}</th>
                                          <th>from {{$schedule->time_from}} to {{$schedule->time_to}}</th>
                                          @if($schedule->training_course_id != null)
                                          <th>{{$schedule->training->name}}</th>
                                          <th>{{$schedule->training->name}}</th>
                                          <th>   </th>
                                          @endif
                                          <th>@if($schedule->doctor_id != null) {{$schedule->doctor->name}} @else Empty @endif</th>
                                        </tr>
                                      @endif
                                      @endforeach
                                      @endif
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <!-- col-4 -->
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                    <div class="card">
                        <div class="card-header" role="tab" id="headingTwo">
                            <h6 class="mg-b-0">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" class="tx-gray-800 transition collapsed"
                                style="background-color: #e9ecef; color: #000;">
                                  Consulting
                                </a>
                            </h6>
                        </div>
                        <!-- card-header -->

                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" style="background-color: #fff; color: #000;">
                            <div class="card-block pd-20">
                                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                                  <div class="bd bd-gray-300 rounded table-responsive">
                                    <table class="table mg-b-0">
                                      <thead>
                                        <tr>
                                          <th>Type</th>
                                          <th>Date</th>
                                          <th>Time</th>
                                          <th>Program</th>
                                          <th>Course</th>
                                          <th>Intake</th>
                                          <th>Doctor</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @if($student->studentSchedules != null) 
                                      @foreach($student->studentSchedules as $schedule)
                                      @if($schedule->service == "consulting")
                                        <tr>
                                          <th>{{$schedule->type}}</th>
                                          <th>{{$schedule->date}}</th>
                                          <th>from {{$schedule->time_from}} to {{$schedule->time_to}}</th>
                                          @if($schedule->program_id == null && $schedule->diplom_id == null && $schedule->training_course_id == null)
                                          <th>{{$schedule->service}}</th>
                                          <th>   </th>
                                          <th>   </th>
                                          @endif
                                          <th>@if($schedule->doctor_id != null) {{$schedule->doctor->name}} @else Empty @endif</th>
                                        </tr>
                                      @endif
                                      @endforeach
                                      @endif
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <!-- col-4 -->
                            </div>
                        </div>
                    </div>
                    <!-- card -->
                  </div>
                  <!-- accordion -->
              </div><!-- card -->
            </div><!-- col-lg-8 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="work">
          @if($student->corporate != null) 
          <!--<div class="row row-xs mg-b-15">
            <div class="col-lg-5"><p> </p></div>
            <div class="col-lg-2"><img src="{{asset('images/corporates').'/'.$student->corporate->logo}}" class="img-fluid" alt=""></div>
            <div class="col-lg-5"><p> </p></div>
          </div>-->
          <div class="row">
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Contact Information</h6>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Phone Number</label>
                <p class="tx-inverse mg-b-25">{{$student->mobile1}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email Address</label>
                <p class="tx-inverse mg-b-25">{{$student->email1}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Home Address</label>
                <p class="tx-inverse mg-b-25">{{$student->street}} St, {{$student->area}}, {{$student->city}}, {{$student->country}}.</p>
                @if($student->corporate != null) 
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Office Address</label>
                <p class="tx-inverse mg-b-50">{{$student->corporate->street}} St, {{$student->corporate->area}}, {{$student->corporate->city}}, {{$student->corporate->country}}, Behind: {{$student->corporate->landmark}}.</p>
                @endif
              </div><!-- card -->
            </div><!-- col-lg-4 -->
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-14 mg-b-30">Education Info</h6>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Faculty</label>
                <p class="tx-inverse mg-b-25">{{$student->faculty}}</p>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">University</label>
                <p class="tx-inverse mg-b-25">{{$student->university}}</p>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Major</label>
                <p class="tx-inverse mg-b-25">{{$student->major}}</p>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Degree</label>
                <p class="tx-inverse mg-b-25">{{$student->degree}}</p>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Grade</label>
                <p class="tx-inverse mg-b-25">{{$student->grade}}%</p>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Graduation Date</label>
                <p class="tx-inverse mg-b-25">{{(new DateTime($student->date))->format('d-m-Y')}}</p>
              </div><!-- card -->
            </div><!-- col-lg-8 -->
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Other Information</h6>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Degree</label>
                <p class="tx-inverse mg-b-25">{{$student->degree}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Faculty</label>
                <p class="tx-inverse mg-b-25">{{$student->faculty}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Major</label>
                <p class="tx-inverse mg-b-25">{{$student->major}}</p>

              </div><!-- card -->
            </div><!-- col-lg-4 -->
            <div class="col-lg-12">
            <hr><h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25" style="text-align:center;">Work Experience</h6>
            </div>
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Current Employment</h6>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Employer</label>
                <p class="tx-inverse mg-b-25">{{$student->corporate->name}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Position</label>
                <p class="tx-inverse mg-b-25">{{$student->job}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Industry</label>
                <p class="tx-inverse mg-b-25">{{$student->corporate->industry}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Address</label>
                <p class="tx-inverse mg-b-50">{{$student->corporate->street}} St, {{$student->corporate->area}}, {{$student->corporate->city}}, {{$student->corporate->country}}, Behind: {{$student->corporate->landmark}}.</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Website</label>
                <p class="tx-inverse mg-b-25">{{$student->corporate->website}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email</label>
                <p class="tx-inverse mg-b-25">{{$student->corporate->email}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Mobile</label>
                <p class="tx-inverse mg-b-25">{{$student->corporate->mobile}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Fax</label>
                <p class="tx-inverse mg-b-25">{{$student->corporate->fax}}</p>

              </div><!-- card -->
            </div><!-- col-lg-4 -->
            @foreach($student->studentCorporates as $corporate)
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Previous Work</h6>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Employer</label>
                <p class="tx-inverse mg-b-25">{{$corporate->name}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Position</label>
                <p class="tx-inverse mg-b-25">{{$corporate->pivot->position}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Start/End Date</label>
                <p class="tx-inverse mg-b-25">{{$corporate->pivot->from}} / {{$corporate->pivot->to}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Industry</label>
                <p class="tx-inverse mg-b-25">{{$corporate->industry}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Address</label>
                <p class="tx-inverse mg-b-50">{{$corporate->street}} St, {{$corporate->area}}, {{$corporate->city}}, {{$corporate->country}}, Behind: {{$corporate->landmark}}.</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Website</label>
                <p class="tx-inverse mg-b-25">{{$corporate->website}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email</label>
                <p class="tx-inverse mg-b-25">{{$corporate->email}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Mobile</label>
                <p class="tx-inverse mg-b-25">{{$corporate->mobile}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Fax</label>
                <p class="tx-inverse mg-b-25">{{$corporate->fax}}</p>
                </div>
            </div><!-- col-lg-4 -->
            @endforeach
          </div><!-- row -->
          @endif
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="grades">
          <div class="row">
            <div class="col-lg-12">
              <div class="media-list bg-white rounded shadow-base">
                <div class="bd bd-gray-300 rounded table-responsive">
                  <table class="table mg-b-0">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Doctor</th>
                        <th>Course</th>
                        <th>Grade</th>
                        <th>Total</th>
                        <th>GPA</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if($student->studentProgress != null) 
                    @foreach($student->studentProgress as $progress)
                      <tr>
                        <th>{{$progress->date}}</th>
                        <th>{{$progress->doctor->name}}</th>
                        <th>@if($progress->program_course_id != null) {{$progress->programCourse->name}} @elseif($progress->diplom_course_id != null) {{$progress->diplomCourse->name}} @endif</th>
                        <th>{{$progress->grade}}</th>
                        <th>{{$progress->total}}</th>
                        <th>{{$progress->gpa}}</th>
                        <th>{{$progress->status}}</th>
                      </tr>
                    @endforeach
                    @endif
                    </tbody>
                  </table>
                </div>
              </div><!-- card -->
            </div><!-- col-lg-8 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="progress">
          <div class="row">
            <div class="col-lg-12">
              <div class="media-list bg-white rounded shadow-base">
                <div class="bd bd-gray-300 rounded table-responsive">
                  <table class="table mg-b-0">
                    <thead>
                      <tr>
                        <th>Course</th>
                        <th>Status</th>
                        <th>Notes</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if($student->studentCourses != null) 
                    @foreach($student->studentCourses as $course)
                      <tr>
                        <th>@if($course->program_course_id != null) {{$course->programCourse->name}} @elseif($course->diplom_course_id != null) {{$course->diplomCourse->name}} @endif</th>
                        <th>{{$course->status}}</th>
                        <th>{{$course->notes}}</th>
                      </tr>
                    @endforeach
                    @endif
                    </tbody>
                  </table>
                </div>
              </div><!-- card -->
            </div><!-- col-lg-8 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="payment">
          <div class="row">
            <div class="col-lg-12">
              <div class="media-list bg-white rounded shadow-base">
                <div class="bd bd-gray-300 rounded table-responsive">
                  <table class="table mg-b-0">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Amount</th>
                        <th>Currency</th>
                        <th>Type</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($student->cash as $payment)
                        <tr>
                          <td>{{$payment->date}}</td>
                          <td>{{$payment->description}}</td>
                          <td>{{$payment->amount}}</td>
                          <td>{{$payment->currency}}</td>
                          <td>{{$payment->type}}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div><!-- card -->
            </div><!-- col-lg-8 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="plan">
          <div class="row">
            <div class="col-lg-12">
              <div class="media-list bg-white rounded shadow-base">
                <div class="bd bd-gray-300 rounded table-responsive">
                  <table class="table mg-b-0">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Installement</th>
                        <th>Paid/Amount in EGP</th>
                        <th>Paid/Amount in Euro</th>
                        <th>Paid/Amount in USD</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($student->payments as $payment)
                        <tr>
                          <td>{{$payment->date}}</td>
                          <td>{{$payment->name}}</td>
                          <td>@if($payment->egp_amount > 0) {{$payment->egp_paid}}/{{$payment->egp_amount}} @endif @if($payment->egp_balance > 0) (Remaining : {{$payment->egp_balance}}) @endif</td>
                          <td>@if($payment->euro_amount > 0) {{$payment->euro_paid}}/{{$payment->euro_amount}} @endif @if($payment->euro_balance > 0) (Remaining : {{$payment->euro_balance}}) @endif</td>
                          <td>@if($payment->usd_amount > 0) {{$payment->usd_paid}}/{{$payment->usd_amount}} @endif @if($payment->usd_balance > 0) (Remaining : {{$payment->usd_balance}}) @endif</td>
                          <td>
                            <label class="ckbox">
                              <input disabled id="ckbox{{$loop->index+1}}" type="checkbox" @if($payment->paid == 1) checked @endif>
                              <span>Paid</span>
                            </label>
                          </td>
                          <td><a href="{{ route('plan.edit' , ['id' => $payment->id]) }}" class="text-primary edit" title="Edit Payment Plan"><i class="fa fa-edit"></i></a></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div><!-- card -->
            </div><!-- col-lg-8 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="documents">
          <div class="row">
            <div class="col-lg-12">
              <div class="media-list bg-white rounded shadow-base">
                        <div class="bd bd-gray-300 rounded table-responsive">
                            <table class="table mg-b-0">
                                <thead>
                                    <tr>
                                        <th>Document Type</th>
                                        <th>File</th>
                                        <th>Download Link</th>
                                        <th>Check</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($student_documents as $document)
                                        @if($document->student_id == $student->id)
                                            <tr>
                                                @foreach($documents as $d)
                                                @if($document->document_id == $d->id)
                                                    <th>{{$d->name}}</th>
                                                @endif
                                                @endforeach
                                                <td>{{$document->file}}</td>
                                                <td><a target="_blank" href="{{asset("images/students/documents/$document->file")}}"><i class="fa fa-eye"></i></a></td>
                                                <td>
                                                <label class="ckbox">
                                                    <input id="ckbox{{$loop->index+1}}" type="checkbox" checked>
                                                    <span>Uploaded</span>
                                                </label>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="graduation">
          <div class="row">
            <div class="col-lg-8">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0 mg-t-30">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-14 mg-b-30">Recent Photos</h6>

                <div class="row row-xs">
                  <div class="col-6 col-sm-4 col-md-3"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10 mg-sm-t-0"><img src="http://via.placeholder.com/600x600" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10 mg-md-t-0"><img src="http://via.placeholder.com/600x600" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                </div><!-- row -->

                <p class="mg-t-20 mg-b-0">Loading more photos...</p>

              </div><!-- card -->
            </div><!-- col-lg-8 -->
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0 mg-t-30">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-14 mg-b-30">Photo Albums</h6>
                <div class="row row-xs mg-b-15">
                  <div class="col"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col">
                    <div class="overlay">
                      <img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt="">
                      <div class="overlay-body bg-black-5 d-flex align-items-center justify-content-center">
                        <span class="tx-white tx-12">20+ more</span>
                      </div><!-- overlay-body -->
                    </div><!-- overlay -->
                  </div>
                </div><!-- row -->
                <div class="d-flex alig-items-center justify-content-between">
                  <h6 class="tx-inverse tx-14 mg-b-0">Profile Photos</h6>
                  <span class="tx-12">24 Photos</span>
                </div><!-- d-flex -->

                <hr>

                <div class="row row-xs mg-b-15">
                  <div class="col"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col"><img src="http://via.placeholder.com/600x600" class="img-fluid" alt=""></div>
                  <div class="col">
                    <div class="overlay">
                      <img src="http://via.placeholder.com/600x600" class="img-fluid" alt="">
                      <div class="overlay-body bg-black-5 d-flex align-items-center justify-content-center">
                        <span class="tx-white tx-12">20+ more</span>
                      </div><!-- overlay-body -->
                    </div><!-- overlay -->
                  </div>
                </div><!-- row -->
                <div class="d-flex alig-items-center justify-content-between">
                  <h6 class="tx-inverse tx-14 mg-b-0">Mobile Uploads</h6>
                  <span class="tx-12">24 Photos</span>
                </div><!-- d-flex -->

                <hr>

                <div class="row row-xs mg-b-15">
                  <div class="col"><img src="http://via.placeholder.com/300x300/0866C6/FFF" class="img-fluid" alt=""></div>
                  <div class="col"><img src="http://via.placeholder.com/300x300/DC3545/FFF" class="img-fluid" alt=""></div>
                  <div class="col">
                    <div class="overlay">
                      <img src="http://via.placeholder.com/300x300/0866C6/FFF" class="img-fluid" alt="">
                      <div class="overlay-body bg-black-5 d-flex align-items-center justify-content-center">
                        <span class="tx-white tx-12">20+ more</span>
                      </div><!-- overlay-body -->
                    </div><!-- overlay -->
                  </div>
                </div><!-- row -->
                <div class="d-flex alig-items-center justify-content-between">
                  <h6 class="tx-inverse tx-14 mg-b-0">Mobile Uploads</h6>
                  <span class="tx-12">24 Photos</span>
                </div><!-- d-flex -->

                <a href="" class="d-block mg-t-20"><i class="fa fa-angle-down mg-r-5"></i> Show 8 more albums</a>
              </div><!-- card -->
            </div><!-- col-lg-4 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="communicate">
          <div class="row">
            <div class="col-lg-8">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0 mg-t-30">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-14 mg-b-30">Recent Photos</h6>

                <div class="row row-xs">
                  <div class="col-6 col-sm-4 col-md-3"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10 mg-sm-t-0"><img src="http://via.placeholder.com/600x600" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10 mg-md-t-0"><img src="http://via.placeholder.com/600x600" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                  <div class="col-6 col-sm-4 col-md-3 mg-t-10"><img src="http://via.placeholder.com/300x300" class="img-fluid" alt=""></div>
                </div><!-- row -->

                <p class="mg-t-20 mg-b-0">Loading more photos...</p>

              </div><!-- card -->
            </div><!-- col-lg-8 -->
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0 mg-t-30">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-14 mg-b-30">Photo Albums</h6>
                <div class="row row-xs mg-b-15">
                  <div class="col"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col">
                    <div class="overlay">
                      <img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt="">
                      <div class="overlay-body bg-black-5 d-flex align-items-center justify-content-center">
                        <span class="tx-white tx-12">20+ more</span>
                      </div><!-- overlay-body -->
                    </div><!-- overlay -->
                  </div>
                </div><!-- row -->
                <div class="d-flex alig-items-center justify-content-between">
                  <h6 class="tx-inverse tx-14 mg-b-0">Profile Photos</h6>
                  <span class="tx-12">24 Photos</span>
                </div><!-- d-flex -->

                <hr>

                <div class="row row-xs mg-b-15">
                  <div class="col"><img src="http://via.placeholder.com/1000x1000" class="img-fluid" alt=""></div>
                  <div class="col"><img src="http://via.placeholder.com/600x600" class="img-fluid" alt=""></div>
                  <div class="col">
                    <div class="overlay">
                      <img src="http://via.placeholder.com/600x600" class="img-fluid" alt="">
                      <div class="overlay-body bg-black-5 d-flex align-items-center justify-content-center">
                        <span class="tx-white tx-12">20+ more</span>
                      </div><!-- overlay-body -->
                    </div><!-- overlay -->
                  </div>
                </div><!-- row -->
                <div class="d-flex alig-items-center justify-content-between">
                  <h6 class="tx-inverse tx-14 mg-b-0">Mobile Uploads</h6>
                  <span class="tx-12">24 Photos</span>
                </div><!-- d-flex -->

                <hr>

                <div class="row row-xs mg-b-15">
                  <div class="col"><img src="http://via.placeholder.com/300x300/0866C6/FFF" class="img-fluid" alt=""></div>
                  <div class="col"><img src="http://via.placeholder.com/300x300/DC3545/FFF" class="img-fluid" alt=""></div>
                  <div class="col">
                    <div class="overlay">
                      <img src="http://via.placeholder.com/300x300/0866C6/FFF" class="img-fluid" alt="">
                      <div class="overlay-body bg-black-5 d-flex align-items-center justify-content-center">
                        <span class="tx-white tx-12">20+ more</span>
                      </div><!-- overlay-body -->
                    </div><!-- overlay -->
                  </div>
                </div><!-- row -->
                <div class="d-flex alig-items-center justify-content-between">
                  <h6 class="tx-inverse tx-14 mg-b-0">Mobile Uploads</h6>
                  <span class="tx-12">24 Photos</span>
                </div><!-- d-flex -->

                <a href="" class="d-block mg-t-20"><i class="fa fa-angle-down mg-r-5"></i> Show 8 more albums</a>
              </div><!-- card -->
            </div><!-- col-lg-4 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="log">
          <div class="row">
          <div class="col-lg-12">
            <div class="media-list bg-white rounded shadow-base">
                <div class="bd bd-gray-300 rounded table-responsive">
                  <table class="table mg-b-0">
                    <thead>
                      <tr>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Next Action</th>
                        <th>Advisor</th>
                        <th>Lead Rate</th>
                        <th>Lead Temprature</th>
                        <th>Notes</th>
                      </tr>
                    </thead>
                    <tbody>
                    @foreach($activities as $activity)
                      <tr>
                        <th>{{$activity->type}}</th>
                        <th>{{$activity->status}}</th>
                        <th>{{$activity->next_call}}</th>
                        <th>{{$activity->user->name}}</th>
                        <th>{{$activity->rate}}</th>
                        <th>{{$activity->temperature}}</th>
                        <th>{{$activity->notes}}</th>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                </div>
              </div><!-- card -->
              </div>
          </div><!-- row -->
        </div><!-- tab-pane -->
      </div><!-- br-pagebody -->
@endsection
@include('admin.pages.students.index.scripts')