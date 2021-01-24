@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Lead Profile')
@section('styles')
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <!-- Bracket CSS -->
    <link href="{{asset('vendors/toastr/toastr.min.css')}}" rel="stylesheet">
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
            <img src="{{asset('vendors/img/lead.jpg')}}" alt="lead">
          </div><!-- card-profile-img -->
          <h4 class="tx-normal tx-roboto tx-white">{{$lead->full_name}}</h4>
          <h6 class="tx-normal tx-roboto tx-white">{{$lead->job_title}} - {{$lead->company_name}}</h6>
            <div class="col-lg-12">
              <a href="{{ route('sales.activity.add' , ['id' => $lead->id]) }}" class="btn btn-customised">Convert Lead</a>
            </div>
        </div><!-- card-body -->
      </div><!-- card -->

      <div class="tab-content br-profile-body">
        <div class="tab-pane fade active show">
          <div class="row">
            <div class="col-lg-8">
              <div class="media-list bg-white rounded shadow-base">
              @foreach ($activities as $activity)
                <div class="media pd-20 pd-xs-30">
                  <img src="{{asset('images/users').'/'.$advisor->image}}" alt="" class="wd-40 rounded-circle">
                  <div class="media-body mg-l-20">
                    <div class="d-flex justify-content-between mg-b-10">
                      <div>
                        <h6 class="mg-b-2 tx-inverse tx-14">{{$advisor->name}}</h6>
                      </div>
                      <span class="tx-12">{{(new DateTime($activity->created_at))->format('d-m-Y')}} {{(new DateTime($activity->created_at))->format('h:i A')}}</span>
                    </div><!-- d-flex -->
                    <p class="mg-b-20">
                    @if($activity->type != null)<strong style="color:#aa1916;">Type : </strong> {{$activity->type}}  |   @endif
                    @if($activity->status != null)<strong style="color:#aa1916;">Status :</strong> {{$activity->status}}  |   @endif
                    @if($activity->next_call != null)<strong style="color:#aa1916;">Next Call :</strong> {{$activity->next_call}}  |   @endif
                    @if($activity->temperature != null)<strong style="color:#aa1916;">Lead Interest Temperature :</strong> {{$activity->temperature}}  |   @endif
                    @if($activity->rate != null)<strong style="color:#aa1916;">Lead Quality Rate :</strong> {{$activity->rate}} @endif 
                    @if($activity->manager_id != null)<strong style="color:#aa1916;">Lead Assigned By :</strong> {{$activity->manager->name}} @endif 
                    <br> <strong style="color:#aa1916;">Notes :</strong> {{$activity->notes}}</p>
                  </div><!-- media-body -->
                </div><!-- media -->
                @endforeach
              </div><!-- card -->
            </div><!-- col-lg-8 -->
            <div class="col-lg-4 mg-t-30 mg-lg-t-0">
              <div class="card pd-20 pd-xs-30 shadow-base bd-0">
                <h6 class="tx-gray-800 tx-uppercase tx-semibold tx-13 mg-b-25">Lead Information</h6>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Full Name</label>
                <p class="tx-inverse mg-b-25">{{$lead->full_name}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Job Title</label>
                <p class="tx-inverse mg-b-25">{{$lead->job_title}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Company Name</label>
                <p class="tx-inverse mg-b-25">{{$lead->company_name}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Phone Number</label>
                <p class="tx-inverse mg-b-25">{{$lead->phone_number}}</p>

                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Email</label>
                <p class="tx-inverse mg-b-25">{{$lead->email}}</p>
                @if($lead->program_id != null)
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Program</label>
                <p class="tx-inverse mg-b-25">{{$lead->program->name}}</p>
                @endif  
                @if($lead->diplom_id != null)
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Diplom</label>
                <p class="tx-inverse mg-b-25">{{$lead->diplom->name}}</p>
                @endif
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Campaign Date</label>
                <p class="tx-inverse mg-b-25">{{(new DateTime($lead->created_time))->format('d-m-Y')}}</p>
                <label class="tx-10 tx-uppercase tx-mont tx-medium tx-spacing-1 mg-b-2">Joined Date</label>
                <p class="tx-inverse mg-b-25">{{(new DateTime($lead->created_at))->format('d-m-Y')}} {{(new DateTime($lead->created_at))->format('h:i A')}}</p>
              </div><!-- card -->
            </div><!-- col-lg-4 -->
          </div><!-- row -->
        </div><!-- tab-pane -->
      </div><!-- br-pagebody -->
@endsection
@include('admin.pages.sales.profile.scripts')