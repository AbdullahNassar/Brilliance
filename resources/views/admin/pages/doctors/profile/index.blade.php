@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Doctors')
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
          @if($doctor->image != null) 
            <img src="{{asset('images/users').'/'.$doctor->image}}" alt="doctor">
          @else
            <img src="{{asset('vendors/img/lead.jpg')}}" alt="lead">
          @endif
          </div><!-- card-profile-img -->
          <h4 class="tx-normal tx-roboto tx-white">{{$doctor->name}}</h4>
          <h6 class="tx-normal tx-roboto tx-white">@if($doctor->program != null) {{$doctor->program->name}} - {{$doctor->program->university->name}} - @endif @if($doctor->diplom != null) {{$doctor->diplom->name}} - {{$doctor->diplom->university->name}} - @endif  @if($doctor->program_intake_id != null) {{$doctor->programintake->name}} @endif  @if($doctor->diplom_intake_id != null) {{$doctor->diplomintake->name}} @endif</h6>
          <!--<p class="tx-normal tx-roboto tx-white">{{$doctor->description}}</p>

          <p class="mg-b-0 tx-24">
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
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#work" role="tab">Doctor Data</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#progress" role="tab">Progress</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#payment" role="tab">Payments</a></li>
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
                <div class="bd bd-gray-300 rounded table-responsive">
                  <table class="table mg-b-0">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Service</th>
                        <th>Course</th>
                        <th>Intake</th>
                      </tr>
                    </thead>
                    <tbody>
                    @if($doctor->doctorSchedules != null) 
                    @foreach($doctor->doctorSchedules as $schedule)
                      <tr>
                        <th>{{$schedule->date}}</th>
                        <th>from {{$schedule->time_from}} to {{$schedule->time_to}}</th>
                        @if($schedule->program_id != null)
                        <th>{{$schedule->service}} : {{$schedule->program->name}} | {{$schedule->program->university->name}}</th>
                        <th>{{$schedule->programCourse->name}}</th>
                        <th>{{$schedule->programIntake->name}}</th>
                        @endif
                        @if($schedule->diplom_id != null)
                        <th>{{$schedule->service}} : {{$schedule->diplom->name}} | {{$schedule->diplom->university->name}}</th>
                        <th>{{$schedule->diplomCourse->name}}</th>
                        <th>{{$schedule->diplomIntake->name}}</th>
                        @endif
                        @if($schedule->training_course_id != null)
                        <th>{{$schedule->service}} : {{$schedule->training->name}}</th>
                        <th>{{$schedule->training->name}}</th>
                        @endif
                        @if($schedule->program_id == null && $schedule->diplom_id == null && $schedule->training_course_id == null)
                        <th>{{$schedule->service}}</th>
                        <th>   </th>
                        @endif
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
        <div class="tab-pane fade" id="work">
          <div class="row">
            <div class="col-lg-6 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Contact Information</h6>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Phone Number</label>
                <p class="tx-inverse mg-b-25">{{$doctor->mobile}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email Address</label>
                <p class="tx-inverse mg-b-25">{{$doctor->email}}</p>
                <hr>
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Other Information</h6>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Degree</label>
                <p class="tx-inverse mg-b-25">{{$doctor->degree}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Faculty</label>
                <p class="tx-inverse mg-b-25">{{$doctor->faculty}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Major</label>
                <p class="tx-inverse mg-b-25">{{$doctor->major}}</p>
              </div><!-- card -->
            </div><!-- col-lg-4 -->
            <div class="col-lg-6 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-14 mg-b-30">Education Info</h6>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Faculty</label>
                <p class="tx-inverse mg-b-25">{{$doctor->faculty}}</p>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">University</label>
                <p class="tx-inverse mg-b-25">{{$doctor->university}}</p>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Major</label>
                <p class="tx-inverse mg-b-25">{{$doctor->major}}</p>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Degree</label>
                <p class="tx-inverse mg-b-25">{{$doctor->degree}}</p>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Grade</label>
                <p class="tx-inverse mg-b-25">{{$doctor->grade}}%</p>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Graduation Date</label>
                <p class="tx-inverse mg-b-25">{{(new DateTime($doctor->date))->format('d-m-Y')}}</p>
              </div><!-- card -->
            </div><!-- col-lg-8 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="progress">
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
        <div class="tab-pane fade" id="payment">
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
        <div class="tab-pane fade" id="documents">
          <div class="row">
            <div class="col-lg-12">
              <div class="media-list bg-white rounded shadow-base">
                        <div class="bd bd-gray-300 rounded table-responsive">
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

                </div>
              </div><!-- card -->
              </div>
          </div><!-- row -->
        </div><!-- tab-pane -->
      </div><!-- br-pagebody -->
@endsection
@include('admin.pages.doctors.index.scripts')