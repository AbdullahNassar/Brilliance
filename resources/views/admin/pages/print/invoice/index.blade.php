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
@section('title','Print Invoice')
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
            <div class="form-layout form-layout-1">
              <div class="row">
                <div class="col-md-12" style="text-align:center;">
                    <h4 class="tx-gray-800 mg-b-5">Payment Plan</h4>
                </div>
                <div class="col-md-12">
                  <!--<img src="{{asset('vendors/img/logo.png')}}" style="max-width: 260px;">-->
                  <div class="bd rounded table-responsive">
                    <h4 class="tx-gray-800 mg-b-5">Name : {{$student->name}} {{$student->middle_name}} {{$student->last_name}}</h4>
                    <!--<p class="mg-b-0">Do big things with Med Troops, the responsive bootstrap 4 admin template.</p>-->
                    <table class="table table-bordered" style="padding-bottom: 0; margin-bottom: 0;">
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
                      @foreach($payments as $payment)
                        <tr>
                          <td>{{$payment->date}}</td>
                          <td>{{$payment->description}}</td>
                          <td>{{$payment->amount}}</td>
                          <td>{{$payment->currency}}</td>
                          <td>{{$payment->type}}</td>
                        </tr>
                      @endforeach
                        <tr>
                        @if($total_egp > 0)
                          <td>Total EGP : {{$total_egp}}</td>
                          <td></td>
                        @endif
                        @if($total_euro > 0)
                          <td>Total Euro : {{$total_euro}}</td>
                          <td></td>
                        @endif
                        @if($total_usd > 0)
                          <td>Total USD : {{$total_usd}}</td>
                        @endif
                        </tr>
                    </tbody>
                  </table>
                  </div>
                </div>
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
@include('admin.pages.print.invoice.scripts')