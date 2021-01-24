@extends('admin.layouts.master')
@section('meta')
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Med Troops">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/bracket/img/bracket-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/bracket">
    <meta property="og:title" content="Med Troops">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/bracket/img/bracket-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
@endsection
@section('title','Advisors Leads Report')
@section('styles')
    <!-- vendor css -->
    <link href="{{asset('vendors/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/jquery-switchbutton/jquery.switchButton.css')}}" rel="stylesheet">
    <link href="{{asset('vendors/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">

    <!-- Med Troops CSS -->
    <link rel="stylesheet" href="{{asset('vendors/css/bracket.css')}}">
@endsection
@section('content')
        <div class="br-pagebody">
          <div class="br-section-wrapper" id="printableArea">
              <div class="row">
                <div class="col-md-12" style="text-align:center;">
                    <h4 class="tx-gray-800 mg-b-5">Advisors Leads Report</h4>
                </div>
                <div class="col-md-12">
                  <!--<img src="{{asset('vendors/img/logo.png')}}" style="max-width: 260px;">-->
                        <table id="leads_datatable" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th></th>
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
                                        <td @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif></td>
                                        <th @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif><a href="{{ route('lead.profile' , ['id' => $item->id]) }}" @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>{{$item->full_name}}</a></th>
                                        <th @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>{{$item->phone_number}}</th>
                                        <th @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>{{$item->temperature}}</th>
                                        <th @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>{{$item->rate}}</th>
                                        <th @if($item->temperature == "Cold") style="color:#5baefb !important;" @elseif($item->temperature == "Warm") style="color:#f3d67b !important;" @elseif($item->temperature == "Hot") style="color:#fd3131 !important;" @endif>{{$item->activity_status}} @if($item->next_call != null) | {{$item->next_call}} @endif</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
              </div>  
          </div>
          <div class="row row-sm mg-t-20">
                <div class="col-12" style="text-align: center;">
                <button id="print"  onclick="printDiv('printableArea')" class="btn btn-oblong btn-outline-primary mg-b-10"><i class="fa fa-print"></i> Print</button>
                </div>
              </div>
        </div>
@endsection
@include('admin.pages.reports.sales.leads.scripts')
