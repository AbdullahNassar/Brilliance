@extends('admin.layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">
    <meta name="csrf_token" content="{{csrf_token()}}">
@endsection
@section('title','Sales Tickets')
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
            <a class="breadcrumb-item" href="{{route('marketing.sales.leads')}}">Sales Tickets</a>
            <span class="breadcrumb-item active">Sales Tickets Table</span>
        </nav>
        </div><!-- br-pageheader -->
        <div class="br-pagebody">
            <div class="br-section-wrapper">
                <h6 class="tx-gray-800 tx-uppercase tx-bold tx-14 mg-b-10">Sales Tickets Table</h6>
                <p class="mg-b-25 mg-lg-b-50">Searching, ordering and paging goodness will be immediately added to the table.</p>
                    <div class="table-wrapper">
                        <table id="leads_datatable" class="table display responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($leads as $item)
                                    <tr>
                                        <th>{{$loop->index+1}}</th>
                                        <th>{{$item->full_name}}</a></th>
                                        <th>{{$item->phone_number}}</th>
                                        <th>{{$item->email}}</th>
                                        <th>@if($item->status == 0) Pending @elseif($item->status == 1) Approved  @elseif($item->status == 2) Rejected @endif</th>
                                        @if($item->status == 0)
                                        <th><form class="unpublish" method="POST" action="{{route('ticket.approve', ['id' => $item->id])}}">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-outline-danger btn-icon mg-r-5">
                                                <div><i class="icon ion-toggle"></i></div>
                                            </button>
                                        </form></th>
                                        @elseif($item->status == 1)
                                        <th><form class="publish" method="POST" action="{{route('ticket.reject', ['id' => $item->id])}}">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-outline-danger btn-icon mg-r-5">
                                                <div><i class="icon ion-toggle-filled"></i></div>
                                            </button>
                                        </form></th>
                                        @elseif($item->status == 2)
                                        <th><form class="unpublish" method="POST" action="{{route('ticket.approve', ['id' => $item->id])}}">
                                            {{csrf_field()}}
                                            <button type="submit" class="btn btn-outline-danger btn-icon mg-r-5">
                                                <div><i class="icon ion-toggle"></i></div>
                                            </button>
                                        </form></th>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table-wrapper -->
            </div><!-- br-section-wrapper -->
        </div><!-- br-pagebody -->
@endsection
@include('admin.pages.marketing.tickets.scripts')