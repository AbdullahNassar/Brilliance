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
          @if($user->image != null) 
            <img src="{{asset('images/users').'/'.$user->image}}" alt="Student">
          @else
            <img src="{{asset('vendors/img/lead.jpg')}}" alt="lead">
          @endif
          </div><!-- card-profile-img -->
          <h4 class="tx-normal tx-roboto tx-white">{{$user->name}}</h4>
          <h6 class="tx-normal tx-roboto tx-white">{{$user->role}}</h6>
        </div><!-- card-body -->
      </div><!-- card -->

      <div class="ht-70 bg-gray-100 pd-x-20 d-flex align-items-center justify-content-center shadow-base">
        <ul class="nav nav-outline active-info align-items-center flex-row" role="tablist">
          <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#info" role="tab">User Data</a></li>
          <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#work" role="tab">Update Profile</a></li>
        </ul>
      </div>

      <div class="tab-content br-profile-body">
        <div class="tab-pane fade active show" id="info">
          <div class="row">
            <div class="col-lg-12">
              <div class="media-list bg-white rounded shadow-base">
                <div class="col-lg-6 mg-t-30 mg-lg-t-0">
                  <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                    <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Contact Information</h6>

                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Phone Number</label>
                    <p class="tx-inverse mg-b-25">{{$user->mobile1}}</p>

                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email Address</label>
                    <p class="tx-inverse mg-b-25">{{$user->email1}}</p>

                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Home Address</label>
                    <p class="tx-inverse mg-b-25">{{$user->street}} St, {{$user->area}}, {{$user->city}}, {{$user->country}}.</p>

                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Office Address</label>
                    <p class="tx-inverse mg-b-50">{{$user->corporate->street}} St, {{$user->corporate->area}}, {{$user->corporate->city}}, {{$user->corporate->country}}, Behind: {{$user->corporate->landmark}}.</p>
                  </div><!-- card -->
                </div><!-- col-lg-4 -->
                <div class="col-lg-6 mg-t-30 mg-lg-t-0">
                  <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                    <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-14 mg-b-30">Education Info</h6>
                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Faculty</label>
                    <p class="tx-inverse mg-b-25">{{$user->faculty}}</p>
                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">University</label>
                    <p class="tx-inverse mg-b-25">{{$user->university}}</p>
                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Major</label>
                    <p class="tx-inverse mg-b-25">{{$user->major}}</p>
                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Degree</label>
                    <p class="tx-inverse mg-b-25">{{$user->degree}}</p>
                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Grade</label>
                    <p class="tx-inverse mg-b-25">{{$user->grade}}%</p>
                    <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Graduation Date</label>
                    <p class="tx-inverse mg-b-25">{{(new DateTime($user->date))->format('d-m-Y')}}</p>
                  </div><!-- card -->
                </div><!-- col-lg-8 -->
              </div><!-- card -->
            </div><!-- col-lg-8 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
        <div class="tab-pane fade" id="work">
          <div class="row mg-b-25">
              <div class="col-lg-12">
                <div class="user-img-upload">
                  <div class="fileUpload user-editimg">
                      <span><i class="fa fa-camera"></i> Upload</span>
                      <input type="file" id="imgInp" class="upload" name="image" value="{{$user->image}}">
                  </div>
                  @if($user->image != null)
                  <img src="{{asset('images/users/'.$user->image)}}" id="blah" class="img-circle" alt="">
                  @else
                  <img src="{{asset('vendors/img/1.jpg')}}" id="blah" class="img-circle" alt="">
                  @endif
                  <p>User Image : (1000 x 1000)</p><hr>
                </div>
              </div><!-- col-12 -->
              <div class="col-lg-6">
                <div id="fnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Name</label>
                      <input type="hidden" value="{{$user->id}}" name="id">
                      <input class="form-control" value="{{$user->name}}" type="text" name="name" data-parsley-class-handler="#fnWrapper" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="lnWrapper" class="parsley-input">
                  <div class="form-group pmd-textfield pmd-textfield-floating-label">
                      <label class="control-label">Email</label>
                      <input class="form-control" value="{{$user->email}}" type="email" name="email" data-parsley-class-handler="#lnWrapper" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div id="fnWrapper1" class="parsley-input">
                    <div class="form-group pmd-textfield pmd-textfield-floating-label">
                        <label class="control-label">Password</label>
                        <input class="form-control" type="password" name="password" data-parsley-class-handler="#fnWrapper1" autocomplete="off">
                    </div>
                </div>
            </div>
        </div><!-- tab-pane -->
      </div><!-- br-pagebody -->
@endsection
@include('admin.pages.profile.index.scripts')