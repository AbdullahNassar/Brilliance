@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Corporate Profile')
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
            <img src="{{asset('images/corporates/'.$corporate->logo)}}" alt="Student">
          </div><!-- card-profile-img -->
          <h4 class="tx-normal tx-roboto tx-white">{{$corporate->name}}</h4>
          <h6 class="tx-normal tx-roboto tx-white">{{$corporate->industry}}</h6>
          <!--<p class="tx-normal tx-roboto tx-white">{{$corporate->description}}</p>

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
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#info" role="tab">Corporate Data</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#work" role="tab">Corporate Contacts</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#education" role="tab">Corporate Students</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#progress" role="tab">Student Progress</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#payment" role="tab">Payment</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#documents" role="tab">Documents</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#graduation" role="tab">Student Graduation</a></li>
        </ul>
      </div>

      <div class="tab-content br-profile-body">
        <div class="tab-pane fade active show" id="info">
          <div class="row">
            <div class="col-lg-8">
              <div class="media-list bg-white rounded shadow-base">
                @foreach ($activities as $activity)
                <div class="media pd-20 pd-xs-30">
                  <img src="{{asset('images/users').'/'.$activity->user->image}}" alt="" class="wd-40 rounded-circle">
                  <div class="media-body mg-l-20">
                    <div class="d-flex justify-content-between mg-b-10">
                      <div>
                        <h6 class="mg-b-2 tx-inverse tx-14">{{$activity->user->name}}</h6>
                      </div>
                      <span class="tx-12">{{(new DateTime($activity->created_at))->format('d-m-Y')}} {{(new DateTime($corporate->created_at))->format('h:i A')}}</span>
                    </div><!-- d-flex -->
                    <p class="mg-b-20"><strong style="color:#aa1916">Service : </strong> {{$activity->service}}  |   <strong style="color:#aa1916">Status :</strong> {{$activity->status}} @if($activity->next_call != null)  |   <strong style="color:#aa1916">Next Call :</strong> {{$activity->next_call}}@endif 
                    @if($activity->program != null)  |   <strong style="color:#aa1916">Selected Program :</strong> {{$activity->program->name}}@endif
                    @if($activity->diplom != null)  |   <strong style="color:#aa1916">Selected Diploma :</strong> {{$activity->diplom->name}}@endif
                    @if($activity->course != null)  |   <strong style="color:#aa1916">Selected Training Course :</strong> {{$activity->course->name}}@endif
                    <p class="mg-b-20"><strong style="color:#aa1916">Notes :</strong> {{$activity->notes}}</p>
                    @if($activity->proposal != null)<p class="mg-b-20"><strong style="color:#aa1916">Proposal :</strong> <a target="_blank" href="{{asset("images/corporates/documents/$activity->proposal")}}">  {{$activity->proposal}}   <i class="fa fa-eye"></i></a> @endif
                  </div><!-- media-body -->
                </div><!-- media -->
                @endforeach
              </div><!-- card -->
            </div><!-- col-lg-8 -->
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Corporate Information</h6>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Address</label>
                <p class="tx-inverse mg-b-25">{{$corporate->street}} St, {{$corporate->area}}, {{$corporate->city}}, {{$corporate->country}}. Behind : {{$corporate->landmark}}.</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email Address</label>
                <p class="tx-inverse mg-b-25">{{$corporate->email}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Website</label>
                <p class="tx-inverse mg-b-25">{{$corporate->website}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Mobile Number</label>
                <p class="tx-inverse mg-b-25">{{$corporate->mobile}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Fax</label>
                <p class="tx-inverse mg-b-25">{{$corporate->fax}}</p>

                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Other Information</h6>
                @if($corporate->program != null)
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Selected Program</label>
                <p class="tx-inverse mg-b-25">{{$corporate->program->name}}</p>
                @endif
                @if($corporate->diplom != null)
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Selected Diploma</label>
                <p class="tx-inverse mg-b-25">{{$corporate->diplom->name}}</p>
                @endif
                @if($corporate->course != null)
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Selected Training</label>
                <p class="tx-inverse mg-b-25">{{$corporate->course->name}}</p>
                @endif

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Added By</label>
                <p class="tx-inverse mg-b-25">{{$corporate->user->name}}</p>
              </div><!-- card -->
            </div><!-- col-lg-4 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="work">
          <div class="row row-xs mg-b-15">
            <div class="col-lg-5"><p> </p></div>
            <div class="col-lg-2"><img src="{{asset('images/corporates/'.$corporate->logo)}}" class="img-fluid" alt=""></div>
            <div class="col-lg-5"><p> </p></div>
          </div>
          <div class="row">
          @foreach($corporate->contacts as $contact)
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Corporate Contact Info</h6>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Name</label>
                <p class="tx-inverse mg-b-25">{{$contact->name}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Position</label>
                <p class="tx-inverse mg-b-25">{{$contact->position}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email</label>
                <p class="tx-inverse mg-b-25">{{$contact->email}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Mobile</label>
                <p class="tx-inverse mg-b-25">{{$contact->mobile}}</p>

              </div><!-- card -->
            </div><!-- col-lg-4 -->
          @endforeach
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="education">
          <div class="row">
            <div class="col-lg-8">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0 mg-t-30">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-14 mg-b-30">Education Info</h6>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Faculty</label>
                <p class="tx-inverse mg-b-25"> </p>
              </div><!-- card -->
            </div><!-- col-lg-8 -->
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0 mg-t-30">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-14 mg-b-30">Education</h6>
                <div class="row row-xs mg-b-15">
                  <div class="col"><img src="{{asset('vendors/img/education.jpg')}}" class="img-fluid" alt=""></div>
                </div><!-- row -->
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Quotes</label>
                <p class="tx-inverse mg-b-25">“Anyone who has never made a mistake has never tried anything new.”</p>
              </div><!-- card -->
            </div><!-- col-lg-4 -->
          </div><!-- row -->
          <div class="row">
            <div id='calendar'></div>
          </div>
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
      </div><!-- br-pagebody -->
@endsection
@include('admin.pages.corporates.index.scripts')