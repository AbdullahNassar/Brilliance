@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Sales Leads')
@section('styles')
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jt.timepicker/jquery.timepicker.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/spectrum/spectrum.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/bootstrap-tagsinput/bootstrap-tagsinput.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/ion.rangeSlider/css/ion.rangeSlider.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/ion.rangeSlider/css/ion.rangeSlider.skinFlat.css')}}" rel="stylesheet">
    
    <!-- Bracket CSS -->
    <link rel="stylesheet" href="{{asset('vendors/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/css/bracket.css')}}">
    <link href="{{asset('vendors/toastr/toastr.min.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/css/float-labels.css')}}" rel="stylesheet">
@endsection
@section('content')
    <!-- br-mainpanel -->
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="{{route('dashboard')}}">Brilliance</a>
            <a class="breadcrumb-item" href="{{route('marketing.sales.leads')}}">Sales Leads</a>
            <span class="breadcrumb-item active">Sales Leads Table</span>
        </nav>
        </div><!-- br-pageheader -->
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Sales Leads Table</h6>
                <p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the table.</p>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.sales.leads') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.sales.leads')}}">All</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.hot') background-color: #fd3131; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.hot')}}">Hot @if($hot > 0) ({{$hot}}) @endif</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.warm') background-color: #f3d67b; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.warm')}}">Warm @if($warm > 0) ({{$warm}}) @endif</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.cold') background-color: #5baefb; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.cold')}}">Cold @if($cold > 0) ({{$cold}}) @endif</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.follow') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.follow')}}">Time/ Not Decided @if($follow > 0) ({{$follow}}) @endif</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.potential') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.potential')}}">Potential @if($potential > 0) ({{$potential}}) @endif</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.hold') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.hold')}}">Hold @if($hot > 0) ({{$hold}}) @endif</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.noAnswer') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.noAnswer')}}">No Answer @if($noanswer > 0) ({{$noanswer}}) @endif</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.interested') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.interested')}}">Interested @if($interested > 0) ({{$interested}}) @endif</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.outOfReach') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.outOfReach')}}">Out Of Reach @if($outofreach > 0) ({{$outofreach}}) @endif</a>
                <a style="margin-right: 5px; @if(Route::currentRouteName()=='marketing.leads.closed') background-color: #aa1916; color: #ffffff; @endif" class="btn btn-oblong btn-outline-primary mg-b-10 float-left" href="{{route('marketing.leads.closed')}}">Not Interested @if($closed > 0) ({{$closed}}) @endif</a>
                    <div class="table-wrapper">
                        <table id="leads_datatable" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Full Name</th>
                                    <th>Mobile</th>
                                    <th>Temperature</th>
                                    <th>Rate</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads as $item)
                                    <tr @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>
                                        <th @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>{{$loop->index+1}}</th>
                                        <th @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif><a href="{{ route('lead.profile' , ['id' => $item->id]) }}" @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>{{$item->full_name}}</a></th>
                                        <th @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>{{$item->phone_number}}</th>
                                        <th @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>{{$item->temperature}}</th>
                                        <th @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>{{$item->rate}}</th>
                                        <th @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>{{$item->activity_status}} @if($item->next_call != null) | {{$item->next_call}} @endif</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
@endsection
@include('admin.pages.marketing.sales.scripts')